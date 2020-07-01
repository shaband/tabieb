<?php

namespace App\Http\Controllers\Website\Patient;

use App\Http\Controllers\Controller;
use App\Repositories\interfaces\ReservationRepository;
use App\Repositories\interfaces\TransactionRepository;
use App\Services\Facades\PayTabs;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public $repo;

    public function __construct(TransactionRepository $repo)
    {
        $this->repo = $repo;
    }

    public function __invoke(Request $request, ReservationRepository $reservationRepo)
    {

        $paytabs_data = PayTabs::verify($request->payment_reference);

        ['model_type' => $model_type, 'model_id' => $model_id, 'reservation_id' => $reservation_id] = $this->repo::decodeOrderId($paytabs_data['reference_no']);
        $reservation = $reservationRepo->find($reservation_id);
        $this->repo->CreatePayTabTransaction($paytabs_data, $model_type, $model_id, $reservation);
        toast('Saved Successfully', 'success');
        return redirect()->route('home');
    }
}
