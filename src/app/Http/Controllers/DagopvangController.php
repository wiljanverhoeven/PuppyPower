<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Availability;
use Carbon\Carbon;   
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentConfirmation;
use App\Mail\AppointmentNotificationAdmin;

class DagopvangController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with('availability')->get();

        $availabilities = Availability::where('date', '>=', Carbon::today())
            ->orderBy('date')
            ->orderBy('start_time')
            ->get();

        $groupedTimeslots = [];

        foreach ($availabilities as $availability) {
            $date = $availability->date;

            $start = Carbon::parse($availability->date . ' ' . $availability->start_time);
            $end = Carbon::parse($availability->date . ' ' . $availability->end_time);

            while ($start->lt($end)) {
                $slotStart = $start->format('Y-m-d H:i:s');
                $groupedTimeslots[$date][] = [
                    'start' => $slotStart,
                    'start_time' => $start->format('H:i'),
                    'end_time' => $start->copy()->addMinutes(30)->format('H:i'),
                ];
                $start->addMinutes(30);
            }
        }

        $availableDates = array_keys($groupedTimeslots);

        return view('dagopvang.index', compact('appointments', 'availableDates', 'groupedTimeslots'));
    }
    public function create()
    {
        // fetch availabilities
        $availabilities = Availability::where('date', '>=', Carbon::today())
            ->orderBy('date')
            ->orderBy('start_time')
            ->get();

        // group timeslots
        $groupedTimeslots = [];

        foreach ($availabilities as $availability) {
            $date = $availability->date;

            $start = Carbon::parse($availability->date . ' ' . $availability->start_time);
            $end = Carbon::parse($availability->date . ' ' . $availability->end_time);

            // make 30 minute timeslots for availabilites
            while ($start->lt($end)) {
                $slotStart = $start->format('Y-m-d H:i:s');
                $slotEnd = $start->copy()->addMinutes(30)->format('H:i:s');

                $groupedTimeslots[$date][] = [
                    'start' => $slotStart,
                    'start_time' => $start->format('H:i'),
                    'end_time' => $start->copy()->addMinutes(30)->format('H:i'),
                ];

                $start->addMinutes(30);
            }
        }

        // make array with dates
        $availableDates = array_keys($groupedTimeslots);

        return view('dagopvang.create', compact('availableDates', 'groupedTimeslots'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'timeslot' => 'required|date_format:Y-m-d H:i:s',
        ]);

        $startTime = Carbon::parse($request->timeslot);
        $endTime = $startTime->copy()->addMinutes(30);

        // find the availability that belongs to the timeslot
        $availability = Availability::where('date', $startTime->toDateString())
            ->where('start_time', '<=', $startTime->format('H:i:s'))
            ->where('end_time', '>=', $endTime->format('H:i:s'))
            ->firstOrFail();

        // save appointment
        $appointment = new Appointment();
        $appointment->name = $request->name;
        $appointment->email = $request->email;
        $appointment->phone = $request->phone;
        $appointment->availability_id = $availability->id;
        $appointment->appointment_date = $startTime->toDateString();
        $appointment->appointment_time = $startTime->format('H:i:s');
        $appointment->save();

        // update availability
        if ($availability->start_time == $startTime->format('H:i:s') &&
            $availability->end_time == $endTime->format('H:i:s')) {
            $availability->delete();
        } elseif ($availability->start_time == $startTime->format('H:i:s')) {
            $availability->start_time = $endTime->format('H:i:s');
            $availability->save();
        } elseif ($availability->end_time == $endTime->format('H:i:s')) {
            $availability->end_time = $startTime->format('H:i:s');
            $availability->save();
        } else {
            // Split availability
            Availability::create([
                'admin_id' => $availability->admin_id,
                'date' => $availability->date,
                'start_time' => $availability->start_time,
                'end_time' => $startTime->format('H:i:s'),
            ]);

            $availability->start_time = $endTime->format('H:i:s');
            $availability->save();
        }

        // Send mail to user
        Mail::to($request->email)->send(new AppointmentConfirmation($appointment));
        //Send mail to admin
        Mail::to('admin@admin.nl')->send(new AppointmentNotificationAdmin($appointment));
        //success message
        return redirect()->back()->with('success', 'Je afspraak is succesvol ingepland!');
    }

}