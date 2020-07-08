<?php

namespace App\Http\Controllers\Website\Patient;

use App\Http\Controllers\Controller;
use App\Models\Chat;
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

    /**
     * @param Request $request
     * @param ReservationRepository $reservationRepo
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reservationCallback(Request $request, ReservationRepository $reservationRepo)
    {

        $paytabs_data = PayTabs::verify($request->payment_reference);

        ['model_type' => $model_type, 'model_id' => $model_id, 'reservation_id' => $reservation_id] = $this->repo::decodeOrderId($paytabs_data['reference_no']);
        $reservation = $reservationRepo->find($reservation_id);
        $this->repo->CreatePayTabTransaction($paytabs_data, $model_type, $model_id, $reservation);

        toast('Saved Successfully', 'success');

        return redirect()->route('reservation.doctor', $reservation->doctor_id);
    }


    public function quickCallCallback(Request $request, ReservationRepository $reservationRepo)
    {

        $paytabs_data = PayTabs::verify($request->payment_reference);

        [
            'model_type' => $model_type,
            'model_id' => $model_id,
            'reservation_id' => $reservation_id
        ] = $this->repo::decodeOrderId($paytabs_data['reference_no']);

        [
            'sessionId' => $sessionId,
            'token' => $token,
            'reservation' => $reservation
        ] =
            $reservationRepo->startCall($reservation_id, 'doctor', true);

        $this->repo->CreatePayTabTransaction($paytabs_data, $model_type, $model_id, $reservation);


/*        \JavaScript::put([
            'token' => $token,
            'sessionId' => $sessionId,
            'type' => 'patient',
            'Api_key' => config('services.tokbox.key')
        ]);*/

        return view('call', [
            'token' => $token,
            'sessionId' => $sessionId,
            'type' => 'patient',
            'reservation' => $reservation,
            'status' => $reservationRepo::getConstants()['STATUS_ACTIVE'],
            'chat' => new Chat()
        ]);


        toast('Saved Successfully', 'success');

        return redirect()->route('reservation.doctor', $reservation->doctor_id);
    }


}
