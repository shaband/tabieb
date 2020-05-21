<?php

namespace App\Http\Controllers\Website\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Schedules\ScheduleRequest;
use App\Http\Resources\Reservation\ReservationResource;
use App\Models\Reservation;
use App\Repositories\interfaces\AttachmentRepository;
use App\Repositories\interfaces\CategoryRepository;
use App\Repositories\interfaces\DoctorRepository;
use App\Repositories\interfaces\ReservationRepository;
use App\Repositories\interfaces\ScheduleRepository;
use App\Rules\CheckPassword;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Prettus\Validator\Exceptions\ValidatorException;

class DoctorController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public $repo;

    private $path;

    public function __construct(DoctorRepository $repo, $path = 'website.doctor.profile')
    {

        auth()->setDefaultDriver('doctor_api');

        $this->repo = $repo;

        $this->path = $path;

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(CategoryRepository $categoryRepository, ScheduleRepository $scheduleRepo)
    {

        $user = auth()->user();
        $categories = $categoryRepository->getMainCategory()->pluck('name', 'id');

        $schedules = $scheduleRepo->DoctorScheduleGroupedByDay($user->id);

        $sub_categories = $categoryRepository->getSubCategoriesForMainCategory($user->category_id)->pluck('name', 'id');

        $user->sub_category_ids = $user->sub_categories->pluck('id');

        return view('website.doctor.profile.profile', compact('user', 'categories', 'sub_categories', 'schedules'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function changePassword()
    {

        $user = auth()->user();

        return view($this->path . '.change_password', compact('user'));
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, AttachmentRepository $attachmentRepo)
    {
        $rules = [
            "first_name_ar" => "nullable|string|max:191",
            "last_name_ar" => "nullable|string|max:191",
            "first_name_en" => "nullable|string|max:191",
            "last_name_en" => "nullable|string|max:191",
            "description_ar" => "nullable|string",
            "description_en" => "nullable|string",
            "title_ar" => "nullable|string|max:191",
            "title_en" => "nullable|string|max:191",
            "civil_id" => "nullable|numeric",
            "price" => "nullable|numeric",
            "period" => "nullable|numeric",
            "category_id" => 'nullable|integer|exists:categories,id,category_id,NULL',
            "sub_category_ids" => 'nullable|array',
            "sub_category_ids.*" => 'nullable|exists:categories,id,category_id,' . $request->category_id ?? auth()->user()->category_id,
            'email' => 'nullable|email|max:191|unique:doctors,id,' . auth()->id(),
            'password' => 'nullable|string|max:191|confirmed',
            'old_password' => ['required_with:password', 'nullable', 'string
            ', 'max:191', new CheckPassword('doctors', auth()->user()->email)],
            'phone' => 'nullable|numeric|unique:doctors,phone,' . auth()->id(),
            'image' => 'nullable|image',
            'logo' => 'nullable|image',
            'license_number' => 'nullable|integer',

        ];

        \Validator::make($request->all(), $rules)->validate();

        $doctor = $this->repo->update(array_filter($request->all()), auth()->id());

        if ($request->image != null) {
            $image_data = $this->repo->saveFile($request->file('image'), 'doctors');
            $doctor->image()->updateOrCreate(['type' => $image_data['type']], $image_data);
        }
        if ($request->logo != null) {
            $logo_data = $this->repo->saveFile($request->file('logo'), 'doctors', $attachmentRepo::getConstants()['DOCTOR_Logo']);
            $doctor->logo_image()->updateOrCreate(['type' => $logo_data['type']], $logo_data);
        }

        toast(__("Updated Successfully"), 'success');

        return back();
    }


    public function storeSchedule(Request $request, ScheduleRepository $scheduleRepo)
    {
        DB::beginTransaction();
        ['ids' => $ids, 'schedules' => $schedules] = $scheduleRepo->StoreDoctorScheduleGroupedByDay(auth()->id(), $request->schedule);
        $scheduleRepo->deleteDoctorScheduleIfNotExistsInIds(auth()->id(), $ids);
        DB::commit();
        toast(__("Saved Successfully"), 'success');
        return back();
    }

}

