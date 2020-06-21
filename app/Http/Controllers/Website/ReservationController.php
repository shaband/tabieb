<?php

namespace App\Http\Controllers\Website;

use App\Criteria\DoctorSearchCriteria;
use App\Events\NotifyUser;
use App\Http\Controllers\Controller;

use App\Http\Resources\Reservation\ReservationResource;
use App\Models\Chat;
use App\Repositories\interfaces\AttachmentRepository;
use App\Repositories\interfaces\CategoryRepository;
use App\Repositories\interfaces\DoctorRepository;
use App\Repositories\interfaces\ReservationRepository;
use App\Repositories\interfaces\ScheduleRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * @var ScheduleRepository
     */
    protected $scheduleRepo;
    /**
     * @var ReservationRepository
     */
    protected $reservationRepo;
    /**
     * @var DoctorRepository
     */
    protected $doctorRepo;

    /**
     * ReservationController constructor.
     * @param ScheduleRepository $scheduleRepo
     * @param ReservationRepository $reservationRepo
     * @param DoctorRepository $doctorRepo
     */
    public function __construct(ScheduleRepository $scheduleRepo, ReservationRepository $reservationRepo, DoctorRepository $doctorRepo)
    {
        $this->scheduleRepo = $scheduleRepo;
        $this->reservationRepo = $reservationRepo;
        $this->doctorRepo = $doctorRepo;
    }

    public function search(Request $request, CategoryRepository $categoryRepo)
    {

        $categories = $categoryRepo->getMainCategory()->keyBy('id');

        $doctors = $this->doctorRepo->pushCriteria(new DoctorSearchCriteria($request))->with(['ratings:rate', 'category:name_ar,name_en,id', 'sub_categories:name_ar,name_en', 'schedules'])->paginate(10);

        $doctors->each(function ($doctor) use ($categories, $categoryRepo) {
            $doctor->setRelation('category', $categories['category_id'] ?? $categoryRepo->query());
        });


        return view('website.search', compact('categories', 'doctors'));
    }


    public function doctorProfile($id, CategoryRepository $categoryRepo)
    {
        $categories = $categoryRepo->getMainCategory()->keyBy('id');

        $doctor = $this->doctorRepo
            ->with(['ratings' => function ($rating) {
                $rating->with('patient');
                $rating->orderBy('rate');
            },  'category', 'sub_categories', 'schedules'])
            ->find($id)->setRelation('category', $categories['category_id'] ?? $categoryRepo->query());

        return view('website.doctor_page', compact('doctor', 'categories'));
    }


    public function createWithoutBilling(Request $request)
    {

        $inputs = $request->validate([
            'doctor_id' => 'required|integer|exists:doctors,id',
            //   'date' => 'required|date|date_format:Y-m-d',
            'start' => ['required'],
            'end' => ['required'],
            'has_reservation' => 'required|integer|in:0',
            'schedule_id' => 'required|integer|exists:schedules,id',

            //   'communication_type' => 'required|integer|min:1|max:2',
            //   'description' => 'nullable|string',
        ]);
        $inputs['date'] = Carbon::parse($inputs['start']);
        $inputs['from_time'] = Carbon::parse($inputs['start']);
        $inputs['to_time'] = Carbon::parse($inputs['end']);
        $inputs['patient_id'] = auth()->guard('patient')->user()->id;
        $inputs['status'] = $this->reservationRepo::getConstants()['STATUS_ACTIVE'];;


        $reservation = $this->reservationRepo->create($inputs);
        toast('Add Successfully Waiting for Doctor Approval', 'success');
        return back();
    }


    public function doctorCertifications($id, AttachmentRepository $attachmentRepository)
    {
        return view('website.certifications', [
            'certifications' => $attachmentRepository->getDoctorCertifications($id)]);
    }


    public function QuickCall(Request $request)
    {


        [
            'sessionId' => $sessionId,
            'token' => $token,
            'reservation' => $reservation,
        ]
            =
            $this->reservationRepo->makeQuickCall($request);


        return view('call', [
                'token' => $token,
                'sessionId' => $sessionId,
                'type' => 'patient',
                'reservation' => $reservation,
                'status' => $this->reservationRepo::getConstants()['STATUS_ACTIVE'],
                'chat' => new Chat()
            ]
        );
    }

    public function QuickCallRespond(Request $request)
    {
        $reservation = $this->reservationRepo->find($request->reservation_id)->fill([
            'status' => $request->status]);
        if ($request->status == 4) {
            event(new NotifyUser($reservation->patient, 'patient', 'call-refused'));
        }
        $reservation->save();
        return $reservation;

    }

    public function receiveCall(Request $request)
    {

        [
            'sessionId' => $sessionId,
            'token' => $token,
            'reservation' => $reservation
        ] =
            $this->reservationRepo->startCall($request->reservation_id, null,false);
        return view('call', [
            'token' => $token,
            'sessionId' => $sessionId,
            'type' => 'patient',
            'reservation' => $reservation,
            'status' => $this->reservationRepo::getConstants()['STATUS_ACTIVE'],
            'chat' => new Chat()
        ]);

    }


}
