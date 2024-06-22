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
            'incharge' => 'nullable|string',
            'prepared_by' => 'nullable|integer',
            'status' => 'required|in:active,completed,cancelled',
            'priority' => 'required|in:low,medium,high',
            'recurring' => 'required|in:none,daily,weekly,monthly',
        ]);

        Event::create($request->all());

        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

    public function filterEvents(Request $request)
    {
     
        $eventType = $request->input('event_type');
        $events = Event::where('event_type', $eventType)->where('status', 'active')->get();
    
        $html = '';
        foreach ($events as $event) {
            $html .= '<div class="event-box">';
            $html .= '<div class="event-details">';
            $html .= \Carbon\Carbon::parse($event->event_datetime)->format('F j, Y g:iA') . ' - ' . $event->title;
            $html .= '</div>';
            $html .= '<div class="event-status">';
            $html .= '<input type="checkbox" class="event-checkbox" ' . ($event->status == 'active' ? 'checked' : '') . ' data-event-id="' . $event->id . '">';
            $html .= '</div>';
            $html .= '</div>';
        }
    
        return response()->json($html);
    }
    

    
    public function updateStatus(Request $request)
    {
        dd('asd');
        \Log::info('Update Status Request', $request->all()); // Log the request data
    
        $event = Event::find($request->event_id);
        if ($event) {
            $event->status = $request->status;
            $event->save();
            return response()->json(['message' => 'Status updated successfully.'], 200);
        }
    
        return response()->json(['message' => 'Event not found.'], 404);
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
