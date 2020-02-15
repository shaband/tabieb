<?php

namespace App\Http\Controllers\Api\v1\Patient;

use App\Http\Controllers\Controller;
use App\Http\Resources\PatientAnswer\PatientAnswerResource;
use App\Http\Resources\PatientQuestion\PatientQuestionResource;
use App\Repositories\interfaces\BlockRepository;
use App\Repositories\interfaces\PatientAnswerRepository;
use App\Repositories\interfaces\PatientQuestionRepository;
use Illuminate\Http\Request;

class PatientQuestionController extends Controller
{
    public $repo;
    public $answersRepo;

    /**
     * PatientQuestionController constructor.
     * @param PatientQuestionRepository $repo
     * @param PatientAnswerRepository $answersRepo
     */
    public function __construct(PatientQuestionRepository $repo, PatientAnswerRepository $answersRepo)
    {
        $this->repo = $repo;
        $this->answersRepo = $answersRepo;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function questions()
    {
        $questions = $this->repo->all();
        $questions = PatientQuestionResource::collection($questions);

        return responseJson(compact('questions'), __("Loaded Successfully"));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function answers(Request $request)
    {

        $this->validate($request, [
            'answers' => 'required|array',
            'answers.*.question_id' => 'required|integer|exists:patient_questions,id',
            'answers.*.status' => 'required|boolean',
            'answers.*.answer' => 'nullable|string',
        ]);

        $answers = $this->answersRepo->addPatientAnswers($request->answers, ['question']);

        $answers = PatientAnswerResource::collection($answers);


        return responseJson(compact('answers'), __("Saved Successfully"));
    }

    public function patientAnswers()
    {
        $answers = $this->answersRepo->with('question')->findByField('patient_id', auth()->id());
        $answers = PatientAnswerResource::collection($answers);
        return responseJson(compact('answers'), __("Loaded Successfully"));

    }

}
