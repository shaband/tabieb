<?php

namespace App\Http\Controllers\Website\Patient;

use App\Http\Controllers\Controller;
use App\Http\Resources\PatientAnswer\PatientAnswerResource;
use App\Models\PatientQuestion;
use App\Repositories\interfaces\PatientAnswerRepository;
use App\Repositories\interfaces\PatientQuestionRepository;
use App\Repositories\interfaces\PatientRepository;
use Illuminate\Http\Request;

class PatientQuestionController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    protected $repo;
    /**
     * @var PatientRepository
     */
    protected $patientRepo;
    protected $answersRepo;

    public function __construct(PatientQuestionRepository $repo, PatientRepository $patientRepo, PatientAnswerRepository $answerRepo)
    {
        $this->repo = $repo;
        $this->patientRepo = $patientRepo;
        $this->answersRepo = $answerRepo;
    }


    public function index()
    {
        $user = auth()->user();
        $patient_questions = $this->repo->WithAnswersOfPatient($user->id);

        return view('website.patient.profile.questions', compact('patient_questions', 'user'));
    }

    public function Store(Request $request)
    {

        $this->validate($request, [
            'answers' => 'required|array',
            'answers.*.question_id' => 'required|integer|exists:patient_questions,id',
            'answers.*.status' => 'required|boolean',
            'answers.*.answer' => 'nullable|string',
        ]);

        $answers = $this->answersRepo->addPatientAnswers($request->answers, ['question']);

        toast(__("Saved Successfully"), 'success');

        return back();
    }

}
