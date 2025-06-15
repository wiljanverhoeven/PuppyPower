<?php

namespace App\Mail;

use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AppointmentConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $appointment;

    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
    }

    public function build()
    {
        return $this->subject('Bevestiging afspraak bij Dagopvang')
            ->view('emails.appointment_confirmation')
            ->with([
                'name' => $this->appointment->name,
                'date' => $this->appointment->appointment_date,
                'time' => $this->appointment->appointment_time,
            ]);
    }

}
