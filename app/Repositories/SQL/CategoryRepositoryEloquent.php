<?php

namespace App\Repositories\SQL;

use App\Repositories\SQL\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\interfaces\CategoryRepository;
use App\Models\Category;

// use App\Validators\CategoryValidator;

/**
 * Class CategoryRepositoryEloquent.
 *
 * @package namespace App\Repositories\SQL;
 */
class CategoryRepositoryEloquent extends BaseRepository implements CategoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Category::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getMainCategory(): Collection
    {
        return $this->model->main()->get();
    }

    public function getSubCategory(): Collection
    {
        return $this->sub()->get();

    }

    /**
     * @param int $category_id
     * @return Collection
     */
    public function getSubCategoriesForMainCategory(int $category_id): Collection
    {
        return $this->findWhere(['category_id' => $category_id])->each->append('name');

    }

    public function OpenCategoriesList()
    {
        return $this->findByField('blocked_at', null, ['id', 'name_ar', 'name_en'])->pluck('name', 'id');
    }


}
