<?php

namespace App\Repositories\interfaces;

use Illuminate\Database\Eloquent\Model;
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
     * @return iterable
     */
    public function saveFile(UploadedFile $file, string $path = '',$type=null): iterable;

    /**
     * @param Request $request
     * @param int $id
     * @return Model
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function Block(Request $request, int $id);

    public static function getReflection(): \ReflectionClass;

    public static function getConstants($keyContains = null, $returnCount = false);

}
