<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reminder;
use App\Models\Event;
use App\Models\Suguan;
use Carbon\Carbon;

class SchedulerController extends Controller
{
    public function index()
    {
        // Retrieve reminders for the current week
        $currentWeek = Carbon::now()->weekOfYear;
        $reminders = Reminder::where('week_number', $currentWeek)->get();

        // Retrieve all events
        $events = Event::all();
        
        // Retrieve all suguan entries
        $suguan = Suguan::all();

        // Group Suguan by day of the week (Midweek and Weekend)
        $suguan_midweek = $this->groupSuguanByDay($suguan, ['Wednesday', 'Thursday']);
        $suguan_weekend = $this->groupSuguanByDay($suguan, ['Saturday', 'Sunday']);

        // Retrieve the top 1 verse of the week
        $verseOfTheWeek = $reminders->first()->verse_of_the_week;

        return view('scheduler.index', compact('reminders', 'events', 'suguan_midweek', 'suguan_weekend', 'verseOfTheWeek'));
    }

    private function groupSuguanByDay($suguan, $days)
    {
        $grouped = [];
        foreach ($days as $day) {
            $grouped[$day] = $suguan->filter(function ($item) use ($day) {
                $date = Carbon::parse($item->suguan_datetime);
                return $date->isoFormat('dddd') === $day;
            });
        }
        return $grouped;
    }
}
