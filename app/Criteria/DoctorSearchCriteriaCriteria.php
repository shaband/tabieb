<?php

namespace App\Criteria;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class DoctorSearchCriteriaCriteria.
 *
 * @package namespace App\Criteria;
 */
class DoctorSearchCriteriaCriteria implements CriteriaInterface
{
    /**
     * @var Request
     */
    private $request;

    /**
     * DoctorSearchCriteriaCriteria constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Apply criteria in query repository
     *
     * @param Doctor $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        return $model->OfKeyWord($this->request->doctor_name)->ofCategory($this->request->category_id)->OfBetweenTime($this->request->from_time, $this->request->to_time);
    }


}
