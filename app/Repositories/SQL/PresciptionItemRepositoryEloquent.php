<?php

namespace App\Repositories\SQL;

use App\Repositories\SQL\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\interfaces\PresciptionItemRepository;
use App\Models\PresciptionItem;
// use App\Validators\PresciptionItemValidator;

/**
 * Class PresciptionItemRepositoryEloquent.
 *
 * @package namespace App\Repositories\SQL;
 */
class PresciptionItemRepositoryEloquent extends BaseRepository implements PresciptionItemRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PresciptionItem::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
