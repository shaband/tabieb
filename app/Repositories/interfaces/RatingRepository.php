<?php

namespace App\Repositories\interfaces;

use App\Models\Rating;
use App\Repositories\interfaces\BaseInterface;
use Illuminate\Http\Request;

/**
 * Interface RatingRepository.
 *
 * @package namespace App\Repositories\interfaces;
 */
interface RatingRepository extends BaseInterface
{
    /**
     * @param Request $request
     * @return Rating
     */
    public function store(Request $request): Rating;
}
