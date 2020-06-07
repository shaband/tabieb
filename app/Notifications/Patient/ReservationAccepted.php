<?php

namespace App\Notifications\Patient;

use App\Models\Reservation;
use App\Repositories\interfaces\PrescriptionRepository;
use App\Repositories\interfaces\ReservationRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReservationAccepted extends Notification
{
    use Queueable;

    /**
     * @var Reservation
     */
    public $reservation;

    /**
     * Create a new notification instance.
     *
     * @param Reservation $reservation
     */
    public function __construct(Reservation $reservation)
    {
        //
        $this->reservation = $reservation;
    }


    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    public function toArray($notifiable)
    {

        return array_merge($this->notificationData($this->reservation->toArray()), ['html' => $this->renderNotification()]);
    }

    /**
     * Get the type of the notification being broadcast.
     *
     * @return string
     */
    public function broadcastType()
    {
        return app(ReservationRepository::class)->getMorphedAlias();
    }

    /**
     * Get the broadcastable representation of the notification.
     *
     * @param mixed $notifiable
     * @return BroadcastMessage
     */
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage(array_merge($this->notificationData(), ['html' => $this->renderNotification()]));
    }


    public function notificationData(array $additional = [])
    {
        return [
                'title' => 'Reservation Accepted',
                'Message' => 'Your Reservation For Doctor ' . $this->reservation->doctor->name . ' Accepted',
                'image' => url("/design/images/notification1.png"),
                'url' => '',
                'data_id' => $this->reservation->id,
                'date' => $this->reservation->created_at,
            ] + $additional;
    }

    public function renderNotification()
    {
        return view('website.partials._notification_item', $this->notificationData())->toHtml();
    }
}
