<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Appointment;

class AppointmentNotificationAdmin extends Mailable
{
    use Queueable, SerializesModels;
    public $appointment;

    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
    }

    public function build()
    {
        return $this->subject('Nieuwe afspraak ingepland')
            ->view('emails.appointment_admin')
            ->with([
                'name' => $this->appointment->name,
                'phone' => $this->appointment->phone,
                'date' => $this->appointment->appointment_date,
                'time' => $this->appointment->appointment_time,
            ]);
    }

}
