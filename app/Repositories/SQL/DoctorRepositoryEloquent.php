<?php

namespace App\Repositories\SQL;

use App\Models\Doctor;
use App\Repositories\SQL\BaseRepository;
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

}
