<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Admins\AdminRequest;
use App\Http\Requests\Admin\PatientQuestions\PatientQuestionRequest;
use App\Repositories\interfaces\PatientQuestionRepository;
use Illuminate\Http\Request;

class PatientQuestionController extends Controller
{
    protected $repo;

    public function __construct(PatientQuestionRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        $patient_questions = $this->repo->all();

        return view('admin.patient_questions.index', compact('patient_questions'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {

        return view('admin.patient_questions.create');
    }

    /**
     * @param PatientQuestionRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PatientQuestionRequest $request)
    {
        $patient_question = $this->repo->create($request->all());
        toast(__("Added successfully"), 'success');

        return redirect()->route('admin.patient-questions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $patient_question = $this->repo->find($id);
        return view('admin.patient_questions.edit', compact('patient_question'));
    }

    /**
     * @param PatientQuestionRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PatientQuestionRequest $request, $id)
    {
        $patient_question = $this->repo->update($request->all(), $id);

        toast(__("Updated successfully"), 'success');

        return redirect()->route('admin.patient-questions.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->repo->delete($id);
        toast(__("Deleted successfully"), 'success');

        return back();

    }
}
