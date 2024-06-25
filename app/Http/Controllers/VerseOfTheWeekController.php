<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VerseOfTheWeek;
use Carbon\Carbon;

class VerseOfTheWeekController extends Controller
{
    public function index()
    {
        $verses = VerseOfTheWeek::orderBy('id', 'desc')->paginate(5);
        return view('scheduler.verseoftheweek', compact('verses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'verse' => 'required|string|max:255',
            'content' => 'required|string',
            'weeknumber' => 'required|integer',
        ]);
    
        // Check if a verse already exists for the given week number
        $existingVerse = VerseOfTheWeek::where('weeknumber', $request->weeknumber)->first();
    
        if ($existingVerse) {
            return redirect()->route('verseoftheweek.index')->withErrors(['weeknumber' => 'A verse for this week already exists.']);
        }
    
        $now = Carbon::now();
    
        VerseOfTheWeek::create([
            'date' => $now,
            'weeknumber' => $request->weeknumber,
            'verse' => $request->verse,
            'content' => $request->content,
        ]);
    
        return redirect()->route('verseoftheweek.index')->with('success', 'Verse of the Week added successfully.');
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'verse' => 'required|string|max:255',
            'content' => 'required|string',
            'weeknumber' => 'required|integer',
        ]);
    
        // Check if a verse already exists for the given week number, excluding the current one being updated
        $existingVerse = VerseOfTheWeek::where('weeknumber', $request->weeknumber)
                                        ->where('id', '!=', $id)
                                        ->first();
    
        if ($existingVerse) {
            return redirect()->route('verseoftheweek.index')->withErrors(['weeknumber' => 'A verse for this week already exists.']);
        }
    
        $verse = VerseOfTheWeek::findOrFail($id);
        $verse->update($request->all());
    
        return redirect()->route('verseoftheweek.index')->with('success', 'Verse of the Week updated successfully.');
    }
    


    public function destroy($id)
    {
        $verse = VerseOfTheWeek::findOrFail($id);
        $verse->delete();

        return redirect()->route('verseoftheweek.index')->with('success', 'Verse of the Week deleted successfully.');
    }
}
