<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reminder;
use Carbon\Carbon;

class ReminderController extends Controller
{
    public function index()
    {
        $reminders = Reminder::orderBy('id', 'desc')->paginate(5); 
        return view('scheduler_management.reminders', compact('reminders'));
    }

    public function store(Request $request)
    {
       
        $request->validate([
            'reminder_datetime' => 'required|date',
            'reminder' => 'required|string',
            'attendees' => 'required|string',
            'venue' => 'required|string',
            'week_number' => 'nullable|integer',
            'verse_of_the_week' => 'nullable|string',
            'incharge' => 'required|string',
            'prepared_by' => 'nullable|integer',
            'status' => 'required|in:active,completed,cancelled',
            'priority' => 'required|in:low,medium,high',
        ]);
 //dd($request);
        Reminder::create($request->all());

        return redirect()->route('reminders.index')->with('success', 'Reminder created successfully.');
    }

 public function update(Request $request, Reminder $reminder)
{
    $request->validate([
        'edit_reminder_datetime' => 'required|date',
        'edit_reminder' => 'required|string',
        'edit_attendees' => 'required|string',
        'edit_venue' => 'required|string',
        'edit_week_number' => 'nullable|integer',
        'edit_verse_of_the_week' => 'nullable|string',
        'edit_incharge' => 'required|string',
        'edit_prepared_by' => 'nullable|integer',
        'edit_status' => 'required|in:active,completed,cancelled',
        'edit_priority' => 'required|in:low,medium,high',
    ]);

    $reminder->update([
        'reminder_datetime' => $request->edit_reminder_datetime,
        'reminder' => $request->edit_reminder,
        'attendees' => $request->edit_attendees,
        'venue' => $request->edit_venue,
        'week_number' => $request->edit_week_number,
        'verse_of_the_week' => $request->edit_verse_of_the_week,
        'incharge' => $request->edit_incharge,
        'prepared_by' => $request->edit_prepared_by,
        'status' => $request->edit_status,
        'priority' => $request->edit_priority,
    ]);

    //dd($request);
    return redirect()->route('reminders.index')->with('success', 'Reminder updated successfully.');
}
    public function destroy(Reminder $reminder)
    {
        $reminder->delete();

        return redirect()->route('reminders.index')->with('success', 'Reminder deleted successfully.');
    }
}
