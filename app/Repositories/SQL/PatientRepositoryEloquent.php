<?php

namespace App\Repositories\SQL;

use App\Repositories\SQL\BaseRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\interfaces\PatientRepository;
use App\Models\Patient;

// use App\Validators\PatientValidator;

/**
 * Class PatientRepositoryEloquent.
 *
 * @package namespace App\Repositories\SQL;
 */
class PatientRepositoryEloquent extends BaseRepository implements PatientRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Patient::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }


    public function store(Request $request): Patient
    {

        DB::beginTransaction();

        $patient = $this->create($request->all());

        if (is_array($request->device) && isset($request->device['token'])) {

            $patient->fcm_tokens()->ceate($request->device);
        }
        if ($request->image) {
            $image_data = $this->saveFile($request->image, 'patients');
            $patient->image()->updateOrCreate(['type' => $image_data['type']], $image_data);
        }
        DB::commit();

        return $patient->fresh();
    }

    public function verify(Request $request): Patient
    {


        $patient = $this->findByField('verification_code', $request->verification_code)->first();
        $patient->fill([
            'phone_verified_at' => Carbon::now(),
            'email_verified_at' => Carbon::now(),
        ]);

        $patient->save();
        return $patient;
    }


}
