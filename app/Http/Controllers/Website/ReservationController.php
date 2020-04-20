<?php

namespace App\Http\Controllers\Website;

use App\Criteria\DoctorSearchCriteriaCriteria;
use App\Http\Controllers\Controller;

use App\Repositories\interfaces\AttachmentRepository;
use App\Repositories\interfaces\CategoryRepository;
use App\Repositories\interfaces\DoctorRepository;
use App\Repositories\interfaces\ReservationRepository;
use App\Repositories\interfaces\ScheduleRepository;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * @var ScheduleRepository
     */
    private $scheduleRepo;
    /**
     * @var ReservationRepository
     */
    private $reservationRepo;
    /**
     * @var DoctorRepository
     */
    private $doctorRepo;

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

        $doctors = $this->doctorRepo->pushCriteria(new DoctorSearchCriteriaCriteria($request))->with('image:file', 'ratings:rate', 'category:name_ar,name_en,id', 'sub_categories:name_ar,name_en', 'schedules')->paginate(10);

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
            }, 'image', 'category', 'sub_categories', 'schedules'])
            ->find($id)->setRelation('category', $categories['category_id'] ?? $categoryRepo->query());

        return view('website.doctor_page', compact('doctor', 'categories'));
    }


    public function doctorCertifications($id, AttachmentRepository $attachmentRepository)
    {
        return view('website.certifications', [
            'certifications' => $attachmentRepository->getDoctorCertifications($id)]);
    }

}
