<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Availability;
use Illuminate\Http\Request;

class AvailabilityController extends Controller
{
    public function index()
    {
        //get availability
        $availabilities = Availability::orderBy('date')->orderBy('start_time')->get();

        $events = $availabilities->map(function ($a) {
            return [
                'id' => $a->id,
                'title' => 'Beschikbaar',
                'start' => $a->date . 'T' . $a->start_time,
                'end' => $a->date . 'T' . $a->end_time,
                'color' => '#28a745', 
                'borderColor' => '#1e7e34',
                'allDay' => false,
                'extendedProps' => [
                    'admin_id' => $a->admin_id
                ]
            ];
        });

        return view('admin.availability.index', [
            'availabilities' => $availabilities,
            'events' => $events->toJson(),
        ]);
    }

    public function create()
    {
        return view('admin.availability.create');
    }

    public function store(Request $request)
    {   
        //add availability
        $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'repeat_weeks' => 'nullable|integer|min:1|max:52',
        ]);

        $repeatWeeks = $request->input('repeat_weeks', 1);
        $date = \Carbon\Carbon::parse($request->date);

        //repeat
        for ($i = 0; $i < $repeatWeeks; $i++) {
            $currentDate = $date->copy()->addWeeks($i);

            //check for overlap
            if ($i > 0) {
                $weekOverlapping = Availability::where('admin_id', auth()->id())
                    ->where('date', $currentDate->format('Y-m-d'))
                    ->where(function ($query) use ($request) {
                        $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                            ->orWhereBetween('end_time', [$request->start_time, $request->end_time])
                            ->orWhere(function ($q) use ($request) {
                                $q->where('start_time', '<=', $request->start_time)
                                ->where('end_time', '>=', $request->end_time);
                            });
                    })
                    ->exists();

                if ($weekOverlapping) {
                    continue;
                }
            }

            Availability::create([
                'admin_id' => auth()->id(),
                'date' => $currentDate->format('Y-m-d'),
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'repeat_weekly' => $repeatWeeks > 1,
            ]);
        }

        $message = $repeatWeeks > 1
            ? 'Beschikbaarheid toegevoegd en herhaald voor ' . $repeatWeeks . ' weken.'
            : 'Beschikbaarheid toegevoegd.';

        return redirect()->route('admin.availability.index')->with('success', $message);
    }

    public function destroy(Availability $availability)
    {

        $availability->delete();

        return redirect()->route('admin.availability.index')
            ->with('success', 'Beschikbaarheid verwijderd.');
    }

    public function edit(Availability $availability)
    {

        return view('admin.availability.edit', compact('availability'));
    }

    public function update(Request $request, Availability $availability)
    {
        //update availability
        $request->validate([
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);
        //check for overlap
        $overlapping = Availability::where('admin_id', auth()->id())
            ->where('id', '!=', $availability->id)
            ->where('date', $request->date)
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                    ->orWhereBetween('end_time', [$request->start_time, $request->end_time])
                    ->orWhere(function ($q) use ($request) {
                        $q->where('start_time', '<=', $request->start_time)
                          ->where('end_time', '>=', $request->end_time);
                    });
            })
            ->exists();

        if ($overlapping) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['overlap' => 'Er bestaat al een beschikbaarheid voor deze tijd.']);
        }

        $availability->update([
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return redirect()->route('admin.availability.index')
            ->with('success', 'Beschikbaarheid bijgewerkt.');
    }
}
