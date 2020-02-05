<?php

namespace App\Repositories\SQL;

use App\Models\Attachment;
use Illuminate\Http\UploadedFile;
use Prettus\Repository\Eloquent\BaseRepository as MainRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\interfaces\BaseInterface;


/**
 * Class BaseRepositoryEloquent.
 *
 * @package namespace App\Repositories\SQL;
 */
abstract class BaseRepository extends MainRepository implements BaseInterface
{


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @param UploadedFile $file
     * @param string $path
     * @return iterable
     */
    public function saveFile(UploadedFile $file,string $path=''): iterable
    {


        $name = date('YmdHis') . '-' . $file->getClientOriginalName();

        $data =
            [
                'file' => 'storage/' . $file->storeAs($path, $name),
                'type' => Attachment::PROFILE_PICTURE,
                'ext' => $file->getClientOriginalExtension()
            ];

        return $data;

    }

}
