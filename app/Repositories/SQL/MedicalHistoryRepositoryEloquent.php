<?php

namespace App\Repositories\SQL;

use App\Repositories\SQL\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\interfaces\MedicalHistoryRepository;
use App\Models\MedicalHistory;

// use App\Validators\MedicalHistoryValidator;

/**
 * Class MedicalHistoryRepositoryEloquent.
 *
 * @package namespace App\Repositories\SQL;
 */
class MedicalHistoryRepositoryEloquent extends BaseRepository implements MedicalHistoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return MedicalHistory::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @param int $patient_id
     * @return mixed
     */
    public function getMedicalHistoryForDoctor(int $patient_id)
    {
        return $this->join('reservations', 'reservations.patient_id', 'medical_histories.patient_id')
            ->where('reservations.doctor_id', auth()->id())
            ->distinct()
            ->with('file')
            ->select('medical_histories.*')
            ->get();
    }
}
