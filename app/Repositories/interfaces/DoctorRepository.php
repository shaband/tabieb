<?php

namespace App\Repositories\interfaces;

use App\Models\Doctor;
use App\Repositories\interfaces\BaseInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

/**
 * Interface DoctorRepository.
 *
 * @package namespace App\Repositories\interfaces;
 */
interface DoctorRepository extends BaseInterface
{
    /**
     * @param Request $request
     * @return Doctor
     */
    public function store(Request $request): Doctor;


    public static function updateRules(): iterable;

    /**
     * @param Request $request
     * @param int $id
     * @return Doctor
     */
    public function UpdateDoctor(Request $request, int $id): Doctor;

    /**
     * @param Request $request
     * @return Collection
     */
    public function doctorsInCategory(Request $request): Collection;

    /**
     * @param Request $request
     * @return Collection
     */
    public function searchInDoctors(Request $request): Collection;

    /**
     * @return Collection
     */
    public function Available(): Collection;

    /**
     * @param Request $request
     * @return Doctor
     */
    public function verify(Request $request): Doctor;


    public function AddFCM(Request $request, Doctor $patient): void;


    public function MobileDoctor(): Builder;
}
