<?php

namespace App\Http\Controllers\Api\v1\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Resources\attachment\AttachmentResource;
use App\Repositories\interfaces\AttachmentRepository;
use Illuminate\Http\Request;

class AttachmentController extends Controller
{

    public $repo;

    public function __construct(AttachmentRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        return responseJson(
            [
                'attachment' => AttachmentResource::collection(auth()->user()->papers)
            ]
            , __("Loaded Successfully"));
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|file|image',
            'name' => 'required|string|max:191'
        ]);


        $attachment = $this->repo->store($request);

        $attachment = new AttachmentResource($attachment);
        return responseJson(compact('attachment'), __("Saved Successfully"));
    }

    public function edit(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|integer|exists:attachments,id,model_type,doctors,model_id,' . auth()->id(),
            'file' => 'nullable|file|image',
            'name' => 'required|string|max:191'
        ]);
        $data = [];
        $data['type'] = $this->repo->getConstants()['DOCTOR_DOCUMENT'];
        $data['name'] = $request->name;
        if ($request->hasFile('file')) {
            $file_data = $this->repo->saveFile($request->file('file'), 'doctors/' . auth()->id() . '/attachments');
            $data = $data + $file_data;
        }

        $attachment = $this->repo->updateOrCreate($request->only('id'), $data);
        $attachment = new AttachmentResource($attachment);
        return responseJson(compact('attachment'), __("Updated Successfully"));
    }

    public function delete(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|integer|exists:attachments,id,model_type,doctors,model_id,' . auth()->id(),
        ]);
        $this->repo->delete($request->id);
        return responseJson(['attachment' => null], __("deleted Successfully"));
    }
}
