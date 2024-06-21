<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('scheduler_management.events', compact('events'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_type' => 'required|in:Meeting,Birthday & Anniversary,Non-Office',
            'event_datetime' => 'required|date',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'incharge' => 'required|string',
            'prepared_by' => 'required|integer',
            'status' => 'required|in:active,completed,cancelled',
            'priority' => 'required|in:low,medium,high',
            'recurring' => 'required|in:none,daily,weekly,monthly',
        ]);

        Event::create($request->all());

        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'event_type' => 'required|in:Meeting,Birthday & Anniversary,Non-Office',
            'event_datetime' => 'required|date',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'incharge' => 'required|string',
            'prepared_by' => 'required|integer',
            'status' => 'required|in:active,completed,cancelled',
            'priority' => 'required|in:low,medium,high',
            'recurring' => 'required|in:none,daily,weekly,monthly',
        ]);

        $event->update($request->all());

        return redirect()->route('events.index')->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }
}
