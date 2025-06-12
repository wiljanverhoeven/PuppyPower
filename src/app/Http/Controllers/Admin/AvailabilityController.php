<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Availability;
use Illuminate\Http\Request;

class AvailabilityController extends Controller
{
    public function index()
    {
        $availabilities = Availability::orderBy('date')->orderBy('start_time')->get();

        $events = $availabilities->map(function ($a) {
            return [
                'id' => $a->id,
                'title' => 'Beschikbaar',  // geen onderscheid meer op type
                'start' => $a->date . 'T' . $a->start_time,
                'end' => $a->date . 'T' . $a->end_time,
                'color' => '#28a745',      // vaste kleur
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
        $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'repeat_weekly' => 'nullable|boolean',
        ]);

        $repeatWeekly = $request->has('repeat_weekly');
        $date = \Carbon\Carbon::parse($request->date);
        $weeksToRepeat = 10;

        $overlapping = Availability::where('admin_id', auth()->id())
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

        for ($i = 0; $i < ($repeatWeekly ? $weeksToRepeat : 1); $i++) {
            $currentDate = $date->copy()->addWeeks($i);

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
                'repeat_weekly' => $repeatWeekly,
            ]);
        }

        $message = $repeatWeekly 
            ? 'Beschikbaarheid toegevoegd en herhaald voor ' . $weeksToRepeat . ' weken.'
            : 'Beschikbaarheid toegevoegd.';

        return redirect()->route('admin.availability.index')->with('success', $message);
    }

    public function destroy(Availability $availability)
    {
        if ($availability->admin_id !== auth()->id()) {
            return redirect()->route('admin.availability.index')
                ->with('error', 'Je kunt alleen je eigen beschikbaarheid verwijderen.');
        }

        $availability->delete();

        return redirect()->route('admin.availability.index')
            ->with('success', 'Beschikbaarheid verwijderd.');
    }

    public function edit(Availability $availability)
    {
        if ($availability->admin_id !== auth()->id()) {
            return redirect()->route('admin.availability.index')
                ->with('error', 'Je kunt alleen je eigen beschikbaarheid bewerken.');
        }

        return view('admin.availability.edit', compact('availability'));
    }

    public function update(Request $request, Availability $availability)
    {
        if ($availability->admin_id !== auth()->id()) {
            return redirect()->route('admin.availability.index')
                ->with('error', 'Je kunt alleen je eigen beschikbaarheid bewerken.');
        }

        $request->validate([
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

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
