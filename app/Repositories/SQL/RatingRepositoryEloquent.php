<?php

namespace App\Repositories\SQL;

use App\Repositories\interfaces\ReservationRepository;
use App\Repositories\SQL\BaseRepository;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\interfaces\RatingRepository;
use App\Models\Rating;

// use App\Validators\RatingValidator;

/**
 * Class RatingRepositoryEloquent.
 *
 * @package namespace App\Repositories\SQL;
 */
class RatingRepositoryEloquent extends BaseRepository implements RatingRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Rating::class;
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
     * @return Rating
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(Request $request): Rating
    {
        $inputs = $request->all();
        $inputs['patient_id'] = auth()->id();
        $reservation = app(ReservationRepository::class)
            ->findWhere([
                'id' => $request->reservation_id,
                'patient_id' => auth()->id(),
            ])->first();
        $inputs['doctor_id'] = $reservation->doctor_id;
        $rate = $this->updateOrCreate(
            [
                'patient_id' => $request->patient_id,
                'reservation_id' => $request->reservation_id,
            ]
            , $inputs);

        return $rate;
    }
}
