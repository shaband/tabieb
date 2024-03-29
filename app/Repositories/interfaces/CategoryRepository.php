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

    public function getSubCategoriesForMainCategory(int $category_id): Collection;
    public function OpenCategoriesList();

       /**
     * Delete a entity in repository by id
     *
     * @param $id
     *
     * @return int
     */
    public function delete($id);
}
