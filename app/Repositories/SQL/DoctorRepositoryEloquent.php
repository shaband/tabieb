<?php

namespace App\Repositories\SQL;

use App\Models\Doctor;
use App\Repositories\SQL\BaseRepository;
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
        DB::commit();
        return $doctor->fresh();

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
        $doctors = $this->makeModel()
            ->with('category','sub_categories')
            ->where('blocked_at', null)
            ->where('category_id', $request->category_id)
            ->get();
        return $doctors;
    }

    public function searchInDoctors(Request $request): Collection
    {
        $model = $this->repo->makeModel()->with('category','sub_categories');

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
            $day = CarbonImmutable::parse($request->date)->weekday();;
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
}
