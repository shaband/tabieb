<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Questions\QuestionRequest;
use App\Repositories\interfaces\QuestionRepository;

class QuestionController extends Controller
{
    protected $repo;
    protected $roleName = 'Question';

    public function __construct(QuestionRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->authorize('View ' . $this->roleName);

        $questions = $this->repo->all();

        return view('admin.questions.index', compact('questions'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('Create ' . $this->roleName);

        return view('admin.questions.create');
    }

    /**
     * @param QuestionRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(QuestionRequest $request)
    {
        $this->authorize('Create ' . $this->roleName);

        $question = $this->repo->create($request->all());
        toast(__("Added successfully"), 'success');

        return redirect()->route('admin.questions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('View ' . $this->roleName);

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $this->authorize('Edit ' . $this->roleName);

        $question = $this->repo->find($id);
        return view('admin.questions.edit', compact('question'));
    }

    /**
     * @param QuestionRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(QuestionRequest $request, $id)
    {
        $this->authorize('Edit ' . $this->roleName);

        $question = $this->repo->update($request->all(), $id);

        toast(__("Updated successfully"), 'success');

        return redirect()->route('admin.questions.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->authorize('Delete ' . $this->roleName);

        $this->repo->delete($id);
        toast(__("Deleted successfully"), 'success');

        return back();

    }
}
