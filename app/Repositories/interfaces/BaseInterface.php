<?php

namespace App\Repositories\interfaces;

use Illuminate\Http\UploadedFile;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface BaseRepository.
 *
 * @package namespace App\Repositories\interfaces;
 */
interface BaseInterface extends RepositoryInterface
{
    public function saveFile(UploadedFile $file, string $path = ''): iterable;

}
