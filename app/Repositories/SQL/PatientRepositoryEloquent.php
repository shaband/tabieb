<?php

namespace App\Repositories\SQL;

use App\Models\Doctor;
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

    /**
     * @param Request $request
     * @return Patient
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(Request $request): Patient
    {

        DB::beginTransaction();

        $patient = $this->create($request->all());

        $this->AddFCM($request, $patient);
        if ($request->image) {
            $image_data = $this->saveFile($request->image, 'patients');
            $patient->image()->updateOrCreate(['type' => $image_data['type']], $image_data);
        }
        DB::commit();

        return $patient->fresh();
    }

    /**
     * @param Request $request
     * @return Patient
     */
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


    /**
     * @param Request $request
     * @param int $id
     * @return Patient
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function UpdatePatient(Request $request, int $id): Patient
    {
        DB::beginTransaction();
        $inputs = $request->except('password');
        if ($request->password != null) $inputs['password'] = $request->password;
        $patient = $this->update($inputs, $id);

        if ($request->image != null) {

            $image_data = $this->saveFile($request->file('image'), 'patients');
            $patient->image()->updateOrCreate(['type' => $image_data['type']], $image_data);
        }

        DB::commit();
        return $patient->fresh();

    }


    /**
     * @param Request $request
     * @param Patient $patient
     */
    public function AddFCM(Request $request, Patient $patient): void
    {

        if (is_array($request->device) && isset($request->device['token'])) {

            $patient->fcm_tokens()->ceate($request->device);
        }
    }

    public function generateResetCode(): int
    {
        $code = randNumber();

        if ($this->count(['reset_password_code' => $code]) != 0) {

            $this->generateResetCode();
        }
        return $code;

    }

    public function socialAuthentication()
    {


    }


}
