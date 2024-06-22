<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reminder;
use App\Models\Event;
use App\Models\Suguan;
use Carbon\Carbon;
use App\Helpers\helpers;

class SchedulerController extends Controller
{
    public function index()
    {
        // Retrieve reminders for the current week
        $currentWeek = Carbon::now()->weekOfYear;
        $reminders = Reminder::where('week_number', $currentWeek)->get();
    
        // Retrieve all active events
        $events = Event::where('status', 'active')->get();
        
        // Retrieve all suguan entries, ordered by suguan_datetime ascending
        $suguan = Suguan::orderBy('suguan_datetime', 'asc')->get();
    
        // Group Suguan by day of the week (Midweek and Weekend)
        $suguan_midweek = $this->groupSuguanByDay($suguan, ['Wednesday', 'Thursday']);
        $suguan_weekend = $this->groupSuguanByDay($suguan, ['Saturday', 'Sunday']);
    
        // Retrieve the top 1 verse of the week
        $verseOfTheWeek = $reminders->isNotEmpty() ? $reminders->first()->verse_of_the_week : 'No verse available for this week.';
    
        return view('scheduler.index', compact('reminders', 'events', 'suguan_midweek', 'suguan_weekend', 'verseOfTheWeek'));
    }
    
   
    

public function getAcronym()
{
    require_once app_path() . '/Helpers/helpers.php';
    // ...
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
