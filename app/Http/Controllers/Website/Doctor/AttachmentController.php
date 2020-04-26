<?php

namespace App\Http\Controllers\Website\Doctor;

use App\Http\Controllers\Controller;
use App\Repositories\interfaces\AttachmentRepository;
use App\Repositories\interfaces\DoctorRepository;
use Illuminate\Http\Request;

class AttachmentController extends Controller
{
    protected $repo;

    /**
     * @var DoctorRepository
     */
    private $doctorRepo;
    private $doctor;

    /**
     * AttachmentController constructor.
     * @param AttachmentRepository $repo
     * @param DoctorRepository $doctorRepo
     */
    public function __construct(AttachmentRepository $repo, DoctorRepository $doctorRepo)
    {
        $this->repo = $repo;
        $this->doctorRepo = $doctorRepo;
    }


    public function index()
    {
        $user = auth()->user();
        $attachments = $papers = auth()->user()->papers;

        return view('website.doctor.profile.documents', compact('user', 'attachments'));
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'file' => 'required|file|mimes:|mimes:jpeg,bmp,png,jpg,svg,pdf,doc,docx',
            'name' => 'required|string|max:191'
        ]);

        $attachment = $this->repo->store($request);

        toast(__("Saved Successfully"), 'success');
        return back();
    }


    public function delete($id, Request $request)
    {

        $request->merge(['id' => $id]);
        $this->validate($request, [
            'id' => 'required|integer|exists:attachments,id,model_type,doctors,model_id,' . auth()->id(),
        ]);
        $this->repo->delete($request->id);
        toast(__("deleted Successfully"), 'success');
        return back();
    }

}
