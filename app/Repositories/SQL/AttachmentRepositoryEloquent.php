<?php

namespace App\Repositories\SQL;

use App\Repositories\SQL\BaseRepository;
use Composer\DependencyResolver\Request;
use Illuminate\Http\UploadedFile;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\interfaces\AttachmentRepository;
use App\Models\Attachment;
// use App\Validators\AttachmentValidator;

/**
 * Class AttachmentRepositoryEloquent.
 *
 * @package namespace App\Repositories\SQL;
 */
class AttachmentRepositoryEloquent extends BaseRepository implements AttachmentRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Attachment::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }



}
