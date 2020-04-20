<?php

namespace App\Repositories\SQL;

use App\Repositories\SQL\BaseRepository;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use phpDocumentor\Reflection\Types\Self_;
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


    public function store(Request $request): Attachment
    {

        $data = $this->saveFile($request->file('file'), 'doctors/' . auth()->id() . '/attachments');
        $data['type'] = self::getConstants()['DOCTOR_DOCUMENT'];
        $data['name'] = $request->name;
        $attachment = auth()->user()->papers()->create($data);
        return $attachment;
    }

    /**
     * get doctor certifications
     * @param int $id
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Support\Collection|mixed
     * @throws \ReflectionException
     */
    public function getDoctorCertifications(int $id)
    {
        return $this->findWhere([
            'model_id' => $id,
            'model_type' => 'doctors',
            'type' => self::getConstants()['DOCTOR_DOCUMENT']
        ]);
    }
}
