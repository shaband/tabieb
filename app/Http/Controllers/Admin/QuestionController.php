<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Questions\QuestionRequest;
use App\Repositories\interfaces\QuestionRepository;

class QuestionController extends Controller
{
    private $repo;

    public function __construct(QuestionRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        $questions = $this->repo->all();

        return view('admin.questions.index', compact('questions'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {

        return view('admin.questions.create');
    }

    /**
     * @param QuestionRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(QuestionRequest $request)
    {
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
        //
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
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
        $this->repo->delete($id);
        toast(__("Deleted successfully"), 'success');

        return back();

    }
}
