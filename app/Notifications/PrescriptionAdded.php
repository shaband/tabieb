<?php

namespace App\Notifications;

use App\Models\Prescription;
use App\Repositories\interfaces\PrescriptionRepository;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class PrescriptionAdded extends Notification
{
    //use Queueable;

    public $prescription;

    /**
     * Create a new notification instance.
     *
     * @param Prescription $prescription
     */

    public function __construct(Prescription $prescription)
    {
        $this->prescription = $prescription;
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

        return array_merge($this->notificationData($this->prescription->toArray()), ['html' => $this->renderNotification()]);
    }

    /**
     * Get the type of the notification being broadcast.
     *
     * @return string
     */
    public function broadcastType()
    {
        return app(PrescriptionRepository::class)->getMorphedAlias();
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
                'title' => 'Prescription Added',
                'Message' => 'You Have Got New Prescription From ' . $this->prescription->doctor->name,
                'image' => url("/design/images/notification2.png"),
                'url' => route('patient.prescription.show', $this->prescription->reservation_id),
                'data_id' => $this->prescription->id,
                'date' => $this->prescription->created_at,
            ] + $additional;
    }

    public function renderNotification()
    {
        return view('website.partials._notification_item', $this->notificationData())->toHtml();
    }
}
