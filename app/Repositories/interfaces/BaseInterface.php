<?php

namespace App\Repositories\interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface BaseRepository.
 *
 * @package namespace App\Repositories\interfaces;
 */
interface BaseInterface extends RepositoryInterface
{

    // public function firstWhere(array $where, $columns = ['*']);

    // public function firstByField($field, $value, $columns = ['*']);

    /**
     * @return mixed
     */
    public function cursor();

    /**
     * @param UploadedFile $file
     * @param string $path
     * @return array
     */
    public function saveFile(UploadedFile $file, string $path = '', $type = null): array;

    /**
     * @param Request $request
     * @param int $id
     * @return Model
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function Block(Request $request, int $id);

    public static function getReflection(): \ReflectionClass;

    public static function getConstants($keyContains = null, $returnCount = false);

    public static function getConstantsFlipped($keyContains = null, $returnCount = false);


    /*
     * get all alias with  it's reference models
     */
    public function getAliasReference(): array;

    /**
     * get model alias
     * @param null $model
     * @return mixed|string
     */
    public function getMorphedAlias($model = null): string;

}
