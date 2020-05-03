<?php

namespace App\Repositories\SQL;

use App\Models\Attachment;
use App\Repositories\SQL\BaseRepository;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            ->with('image', 'creator')
            ->select('medical_histories.*')
            ->addSelect(
                [
                    'image' => Attachment::select('file')
                        ->whereColumn('attachments.model_id', 'medical_histories.id')
                        ->OfModelType($this->getMorphedAlias())
                        ->limit(1)
                ])
            ->get();
    }


    /**
     * store medical history with  image if included
     * @param array $attributes
     * @return mixed
     */

    public function store($attributes)
    {

        DB::beginTransaction();

        $medical_history = $this->create($attributes);

        if (isset($attributes['image'])) {
            $image_data = $this->saveFile($attributes['image'], 'medical_histories', Attachment::MEDICAL_HISTORY);
            $medical_history->image()->updateOrCreate(['type' => $image_data['type']], $image_data);
        }
        DB::commit();

        return $medical_history->fresh();
    }

}
