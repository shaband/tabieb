<?php

namespace App\Repositories\SQL;

use App\Models\Doctor;
use App\Repositories\SQL\BaseRepository;
use App\Rules\CheckPassword;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\interfaces\DoctorRepository;

// use App\Validators\DoctorValidator;

/**
 * Class DoctorRepositoryEloquent.
 *
 * @package namespace App\Repositories\SQL;
 */
class DoctorRepositoryEloquent extends BaseRepository implements DoctorRepository

{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Doctor::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function store(Request $request): Doctor
    {
        DB::beginTransaction();
        $doctor = $this->create($request->all());
        if ($request->image != null) {
            $image_data = $this->saveFile($request->file('image'), 'doctors');
            $doctor->image()->updateOrCreate(['type' => $image_data['type']], $image_data);
        }
        $doctor->sub_categories()->sync($request->sub_category_ids);
        $this->AddFCM($request, $doctor);
        DB::commit();
        return $doctor->fresh();

    }


    public static function updateRules(): iterable
    {
        return [
            "first_name_ar" => "nullable|string|max:191",
            "last_name_ar" => "nullable|string|max:191",
            "first_name_en" => "nullable|string|max:191",
            "last_name_en" => "nullable|string|max:191",
            "description_ar" => "nullable|string",
            "description_en" => "nullable|string",
            "title_ar" => "nullable|string|max:191",
            "title_en" => "nullable|string|max:191",
            "civil_id" => "nullable|numeric",
            "price" => "nullable|numeric",
            "period" => "nullable|numeric",
            "category_id" => 'nullable|integer|exists:categories,id,category_id,NULL',
            "sub_category_ids" => 'nullable|array',
            "sub_category_ids.*" => 'nullable|exists:categories,id,category_id,' . request()->category_id ?? auth()->user()->category_id,
            'email' => 'nullable|email|max:191|unique:doctors,id,' . auth()->id(),
            'password' => 'nullable|string|max:191|confirmed',
            'old_password' => ['required_with:password', 'nullable', 'string
            ', 'max:191', new CheckPassword('doctors', auth()->user()->email)],
            'phone' => 'nullable|numeric|unique:doctors,phone,' . auth()->id(),
            'image' => 'nullable|image',
        ];
    }


    /**
     * @param Request $request
     * @param int $id
     * @return Doctor
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function UpdateDoctor(Request $request, int $id): Doctor
    {
        DB::beginTransaction();
        $inputs = $request->except('password');
        if ($request->password != null) $inputs['password'] = $request->password;
        $doctor = $this->update($inputs, $id);

        if ($request->image != null) {

            $image_data = $this->saveFile($request->file('image'), 'doctors');
            $doctor->image()->updateOrCreate(['type' => $image_data['type']], $image_data);
        }
        $doctor->sub_categories()->sync($request->sub_category_ids);

        DB::commit();
        return $doctor->fresh();

    }

    /**
     * @param Request $request
     * @return Collection
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function doctorsInCategory(Request $request): Collection
    {
        $doctors = $this->query()
            ->with('category', 'sub_categories')
            ->where('blocked_at', null)
            ->where('category_id', $request->category_id)
            ->get();
        return $doctors;
    }

    public function searchInDoctors(Request $request): Collection
    {
        $model = $this->with(static::DoctorMobileRelations());

        $model = $model->when($request->category_id, function (Builder $builder) use ($request) {
            $builder->where('category_id', $request->category_id);
        });
        $model = $model->when($request->min_price, function (Builder $builder) use ($request) {
            $builder->where('price', '>=', $request->min_price);
        });
        $model = $model->when($request->max_price, function (Builder $builder) use ($request) {
            $builder->where('price', '<=', $request->max_price);
        });

        $model = $model->when($request->date, function (Builder $builder) use ($request) {
            $day = CarbonImmutable::parse($request->date)->weekday();
            $builder->whereHas('schedules', function (Builder $schedule) use ($request, $day) {
                $schedule->where('day', $day + 1);
                $schedule->when(($request->from_time != null), function (Builder $builder) use ($request) {
                    $builder->whereTime('from_time', '<=', CarbonImmutable::parse($request->from_time));
                    $builder->whereTime('to_time', '>=', CarbonImmutable::parse($request->from_time));
                });
                $schedule->when($request->to_time != null, function (Builder $builder) use ($request) {
                    $builder->whereTime('from_time', '<=', CarbonImmutable::parse($request->to_time));
                    $builder->whereTime('to_time', '>=', CarbonImmutable::parse($request->to_time));
                });
            });
        });
        $doctors = $model->get()->sortBy(function (Doctor $doctor) {
            return $doctor->ratings()->avg('rate');
        });
        return $doctors;
    }

    public function Available(): Collection
    {

        $doctors = $this->Available()->get();

        return $doctors;
    }

    /**
     * @param Request $request
     * @return Doctor
     */
    public function verify(Request $request): Doctor
    {


        $patient = $this->findByField('verification_code', $request->verification_code)->first();
        $patient->fill([
            'phone_verified_at' => Carbon::now(),
            'email_verified_at' => Carbon::now(),
        ]);

        $patient->save();
        return $patient;
    }


    /**
     * @param Request $request
     * @param Doctor $doctor
     */
    public function AddFCM(Request $request, Doctor $doctor): void
    {

        if (is_array($request->device) && isset($request->device['token'])) {

            $doctor->fcm_tokens()->ceate($request->device);
        }
    }


    public static function DoctorMobileRelations(): array
    {
        return [
            'category',
            'sub_categories',
            'schedules',
            'papers',
            'ratings' => function ($rating) {
                $rating->with(
                    ['patient' => function ($patient) {
                        $patient->with('image:file');
                        $patient->select('first_name', 'last_name');
                    }]);
            }];
    }

    public function MobileDoctor(): Builder
    {

        return $this->query()
            ->with(self::DoctorMobileRelations())
            ->where('blocked_at', null)
            ->limit(10);
    }

    public function generateResetCode(): int
    {

        $code = randNumber();

        if ($this->count(['reset_password_code' => $code]) != 0) {

            $this->generateResetCode();
        }
        return $code;

    }

}
