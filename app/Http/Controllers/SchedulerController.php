<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reminder;
use App\Models\Event;
use App\Models\Suguan;
use App\Models\VerseOfTheWeek;
use App\Models\BroadcastSuguan;
use Carbon\Carbon;
use App\Helpers\helpers;

class SchedulerController extends Controller
{
    public function index()
    {
        // Get the current date and time
        $now = Carbon::now();

        // Get the current week number
        $week = $now->weekOfYear;

        // Get the current year
        $year = $now->year;

        // Get the first day of the week (Monday)
        $startOfWeek = Carbon::parse($year. '-W'. $week)->startOfWeek();

        // Get the last day of the week (Sunday) at 23:59:59
        $endOfWeek = $startOfWeek->copy()->addDays(6)->endOfDay();
       //0 dd($startOfWeek);
        // Retrieve reminders for the current week
        $reminders = Reminder::whereBetween('reminder_datetime', [$startOfWeek,  $endOfWeek])->get();
    
        //Retrieve events for the current week and with status 'active'
        $events = Event::where('status', 'active')
                        ->whereBetween('event_datetime', [$startOfWeek, $endOfWeek])
                        ->get();
    
        // Retrieve suguan entries for the current week, ordered by suguan_datetime ascending
        $suguan = Suguan::whereBetween('suguan_datetime', [$startOfWeek, $endOfWeek])
                        ->orderBy('suguan_datetime', 'asc')
                        ->get();
    
        // Group Suguan by day of the week (Midweek and Weekend)
        $suguan_midweek = $this->groupSuguanByDay($suguan, ['Wednesday', 'Thursday']);
        $suguan_weekend = $this->groupSuguanByDay($suguan, ['Friday', 'Saturday', 'Sunday']);
    
        // Retrieve the top 1 verse of the week
        //$verseOfTheWeek = VerseOfTheWeek::where('weeknumber', $now->weekOfYear)->first();

        // Retrieve the top 1 verse of the week for the current week
        $verseOfTheWeek = VerseOfTheWeek::where('weeknumber', $now->weekOfYear)->first();

        // If no verse is found for the current week, select a random verse from previous weeks
        if (!$verseOfTheWeek) {
            $verseOfTheWeek = VerseOfTheWeek::where('weeknumber', '<', $now->weekOfYear)
                ->inRandomOrder()
                ->first();
        }
        
        // Retrieve Broadcast Suguan for the current week
        $broadcastSuguan = BroadcastSuguan::whereBetween('date', [$startOfWeek, $endOfWeek])
        ->orderBy('date', 'asc')
        ->get();
    
         // Retrieve upcoming birthdays and anniversaries
        $upcomingEvents = json_decode(file_get_contents('http://172.18.125.134:8082/api/upcoming-events'), true);


        return view('scheduler.index', compact('reminders', 'events', 'suguan_midweek', 'suguan_weekend', 'verseOfTheWeek', 'broadcastSuguan', 'upcomingEvents'));
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
