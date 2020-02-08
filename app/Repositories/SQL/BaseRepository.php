<?php

namespace App\Repositories\SQL;

use App\Models\Attachment;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
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
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function cursor()
    {
        $this->applyCriteria();
        $this->applyScope();

        if ($this->model instanceof Builder) {
            $results = $this->model->get();
        } else {
            $results = $this->model->cursor();
        }

        $this->resetModel();
        $this->resetScope();

        return $this->parserResult($results);
    }

    /**
     * @param UploadedFile $file
     * @param string $path
     * @return iterable
     */
    public function saveFile(UploadedFile $file, string $path = ''): iterable
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

    /**
     * @param Request $request
     * @param int $id
     * @return Model
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function Block(Request $request, int $id)
    {
        $fields = [
            'blocked_at' => $request->block ? Carbon::now() : null,
            'block_reason' => $request->block_reason
        ];
        $model = $this->update($fields, $id);
        return $model;
    }

}
