<?php

namespace App\Repositories\SQL;

use App\Models\Attachment;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Prettus\Repository\Eloquent\BaseRepository as MainRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\interfaces\BaseInterface;
use ReflectionClass;


/**
 * Class BaseRepositoryEloquent.
 *
 * @package namespace App\Repositories\SQL;
 */
abstract class BaseRepository extends MainRepository implements BaseInterface
{


    protected $per_page = 10;

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }


    /**
     * Find data by multiple fields
     *
     * @param array $where
     * @param array $columns
     *
     * @param bool $pagination
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function findWhere(array $where, $pagination = false, $columns = ['*'])
    {
        $this->applyCriteria();
        $this->applyScope();

        $this->applyConditions($where);
        $model = $this->model->select($columns);
        if ($pagination) {
            $model = $model->paginate($this->per_page);
        } else {
            $model = $model->get();
        }
        $this->resetModel();

        return $this->parserResult($model);

    }

    /**
     * @param array $attributes
     * @param array $values
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Support\Collection|mixed
     */
    public function firstOrCreate(array $attributes = [], $values = [])
    {
        return $this->model->firstOrCreate($attributes, $values);

    }

    /**
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public
    function cursor()
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
     * @param null $type
     * @return array
     */
    public
    function saveFile(UploadedFile $file, string $path = '', $type = null): array
    {


        $name = date('YmdHis') . '-' . $file->getClientOriginalName();

        $data =
            [
                'file' => 'storage/' . $file->storeAs($path, $name),
                'type' => $type ?? Attachment::PROFILE_PICTURE,
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
    public
    function Block(Request $request, int $id)
    {
        $fields = [
            'blocked_at' => $request->block ? Carbon::now() : null,
            'block_reason' => $request->block_reason
        ];
        $model = $this->update($fields, $id);
        return $model;
    }

    /**
     * @return ReflectionClass
     * @throws \ReflectionException
     */
    public
    static function getReflection(): ReflectionClass
    {
        $model = app(get_called_class())->model();

        return new ReflectionClass($model);
    }

    /**
     * @param null $keyContains
     * @param bool $returnCount
     * @return array|int
     * @throws \ReflectionException
     */
    public
    static function getConstants($keyContains = null, $returnCount = false)
    {
        // Get all constants
        $constants = self::getReflection()->getConstants();
        // Return filtered constants based on constants names filter
        if (!empty($keyContains)) {
            $constants = array_filter($constants, function ($k) use ($keyContains) {
                return strpos($k, $keyContains) === 0;
            }, ARRAY_FILTER_USE_KEY);
        }

        if ($returnCount) {
            return count($constants);
        }
        return $constants;
    }


    public
    static function getConstantsFlipped($keyContains = null, $returnCount = false)
    {
        $constants = self::getConstants($keyContains, $returnCount);

        return array_flip($constants);

    }


    /*
     * get all alias with  it's reference models
     */
    public
    function getAliasReference(): array
    {
        return array_flip(Relation::morphMap());

    }

    /**
     * get model alias
     * @param null $model
     * @return string
     */
    public
    function getMorphedAlias($model = null): string
    {

        $model = $model ?? $this->model();

        return $this->getAliasReference()[$model] ?? $model;
    }

}
