<?php

namespace App\Repositories\interfaces;

use App\Repositories\interfaces\BaseInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface CategoryRepository.
 *
 * @package namespace App\Repositories\interfaces;
 */
interface CategoryRepository extends BaseInterface
{
    public function getMainCategory(): Collection;

    public function getSubCategory(): Collection;
}
