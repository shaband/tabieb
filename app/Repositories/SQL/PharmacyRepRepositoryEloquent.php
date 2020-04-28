<?php

namespace App\Repositories\SQL;

use App\Models\PharmacyRep;
use App\Repositories\SQL\BaseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\interfaces\PharmacyRepRepository;

// use App\Validators\PharmacyRepValidator;

/**
 * Class PharmacyRepRepositoryEloquent.
 *
 * @package namespace App\Repositories\SQL;
 */
class PharmacyRepRepositoryEloquent extends BaseRepository implements PharmacyRepRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PharmacyRep::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }


    /**
     * @param Request $request
     * @return PharmacyRep
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(Request $request): PharmacyRep
    {
        DB::beginTransaction();
        $pharmacy_rep = $this->create($request->all());

        if ($request->image != null) {
            $image_data = $this->saveFile($request->file('image'), '$pharmacy_reps');
            $pharmacy_rep->image()->updateOrCreate(['type' => $image_data['type']], $image_data);
        }
        DB::commit();
        return $pharmacy_rep->fresh();

    }

    public function UpdatePharmacyRep(Request $request, int $id): PharmacyRep
    {
        DB::beginTransaction();
        $inputs = $request->except('password');
        if ($request->password != null) $inputs['password'] = $request->password;
        $pharmacy_rep = $this->update($inputs, $id);

        if ($request->image != null) {

            $image_data = $this->saveFile($request->file('image'), 'pharmacy_reps');
            $pharmacy_rep->image()->updateOrCreate(['type' => $image_data['type']], $image_data);
        }
        DB::commit();
        return $pharmacy_rep->fresh();

    }

}
