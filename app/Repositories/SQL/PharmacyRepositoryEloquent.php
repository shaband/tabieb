<?php

namespace App\Repositories\SQL;

use App\Models\Pharmacy;
use App\Repositories\SQL\BaseRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\interfaces\PharmacyRepository;

// use App\Validators\PharmacyValidator;

/**
 * Class PharmacyRepositoryEloquent.
 *
 * @package namespace App\Repositories\SQL;
 */
class PharmacyRepositoryEloquent extends BaseRepository implements PharmacyRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Pharmacy::class;
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
     * @return Pharmacy
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(Request $request): Pharmacy
    {

        DB::beginTransaction();

        $pharmacy = $this->create($request->all());


        if ($request->image) {
            $image_data = $this->saveFile($request->image, 'pharmacies');
            $pharmacy->image()->updateOrCreate(['type' => $image_data['type']], $image_data);
        }
        DB::commit();

        return $pharmacy->fresh();
    }

    /**
     * @param Request $request
     * @return Pharmacy
     */
    public function verify(Request $request): Pharmacy
    {


        $pharmacy = $this->findByField('verification_code', $request->verification_code)->first();
        $pharmacy->fill([
            'phone_verified_at' => Carbon::now(),
            'email_verified_at' => Carbon::now(),
        ]);

        $pharmacy->save();
        return $pharmacy;
    }


    /**
     * @param Request $request
     * @param int $id
     * @return Pharmacy
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function UpdatePharmacy(Request $request, int $id): Pharmacy
    {
        DB::beginTransaction();
        $inputs = $request->all();

        $pharmacy = $this->update($inputs, $id);

        if ($request->image != null) {

            $image_data = $this->saveFile($request->file('image'), 'pharmacies');
            $pharmacy->image()->updateOrCreate(['type' => $image_data['type']], $image_data);
        }

        DB::commit();
        return $pharmacy->fresh();

    }

}
