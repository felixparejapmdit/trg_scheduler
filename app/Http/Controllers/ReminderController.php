<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reminder;

class ReminderController extends Controller
{
    public function index()
    {
        $reminders = Reminder::all();
        return view('scheduler_management.reminders', compact('reminders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'reminder_datetime' => 'required|date',
            'reminder' => 'required|string',
            'week_number' => 'required|integer',
            'verse_of_the_week' => 'required|string',
            'incharge' => 'required|string',
            'prepared_by' => 'nullable|integer',
            'status' => 'required|in:active,completed,cancelled',
            'priority' => 'required|in:low,medium,high',
        ]);

        Reminder::create($request->all());

        return redirect()->route('reminders.index')->with('success', 'Reminder created successfully.');
    }

    public function update(Request $request, Reminder $reminder)
    {
        $request->validate([
            'reminder_datetime' => 'required|date',
            'reminder' => 'required|string',
            'week_number' => 'required|integer',
            'verse_of_the_week' => 'required|string',
            'incharge' => 'required|string',
            'prepared_by' => 'nullable|integer',
            'status' => 'required|in:active,completed,cancelled',
            'priority' => 'required|in:low,medium,high',
        ]);

        $reminder->update($request->all());

        return redirect()->route('reminders.index')->with('success', 'Reminder updated successfully.');
    }

    public function destroy(Reminder $reminder)
    {
        $reminder->delete();

        return redirect()->route('reminders.index')->with('success', 'Reminder deleted successfully.');
    }
}
