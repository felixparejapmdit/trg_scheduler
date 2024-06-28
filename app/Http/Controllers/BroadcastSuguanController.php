<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BroadcastSuguan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\BroadcastSuguanImport;

use App\Exports\BroadcastSuguanExport;
use Maatwebsite\Excel\Sheet;



class BroadcastSuguanController extends Controller
{
    public function index()
    {
      
        $currentWeek = now()->week;
        $startOfWeek = now()->startOfWeek();
        $endOfWeek = now()->endOfWeek();
      
       $broadcastSuguan = BroadcastSuguan::whereBetween('date', [$startOfWeek,  $endOfWeek])->get();
   //dd($startOfWeek);
        return view('scheduler_management.broadcast_suguan', compact('broadcastSuguan', 'currentWeek'));
    }

// In your BroadcastSuguanController.php

public function weeklyData(Request $request, $week)
{
    // Fetch the data for the selected week
    $currentWeek = now()->week;
    $startOfWeek = now()->startOfWeek()->subWeeks($currentWeek - $week);
    $endOfWeek = $startOfWeek->copy()->endOfWeek();

    $data = BroadcastSuguan::whereBetween('date', [$startOfWeek, $endOfWeek])->get();
    // Return the data as JSON
    return response()->json($data);
}

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'name' => 'required|string|max:255',
            'tobebroadcast' => 'required|string|max:255',
        ]);

        $date = Carbon::createFromFormat('Y-m-d\TH:i', $request->date);

        BroadcastSuguan::create([
            'date' => $date,
            'name' => $request->name,
            'tobebroadcast' => $request->tobebroadcast,
        ]);

        return redirect()->route('broadcast_suguan.index')->with('success', 'Broadcast Suguan added successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date',
            'name' => 'required|string|max:255',
            'tobebroadcast' => 'required|string|max:255',
        ]);

        $date = Carbon::createFromFormat('Y-m-d\TH:i', $request->date);

        $broadcast = BroadcastSuguan::findOrFail($id);
        $broadcast->update([
            'date' => $date,
            'name' => $request->name,
            'tobebroadcast' => $request->tobebroadcast,
        ]);

        return redirect()->route('broadcast_suguan.index')->with('success', 'Broadcast Suguan updated successfully.');
    }

    public function edit($id)
    {
        $broadcast = BroadcastSuguan::findOrFail($id);
        return view('scheduler_management.broadcast_suguan.edit', compact('broadcast'));
    }

    public function destroy($id)
    {
        BroadcastSuguan::findOrFail($id)->delete();
        return redirect()->route('broadcast_suguan.index')->with('success', 'Entry deleted successfully.');
    }


public function exportXLSX()
{
    $filename = 'broadcast_suguan_' . Carbon::now()->format('Ymd_His') . '.xlsx';
    return Excel::download(new BroadcastSuguanExport, $filename);
}

    public function exportCSV()
{
    $broadcastSuguan = BroadcastSuguan::all();
    $filename = 'broadcast_suguan_' . Carbon::now()->format('Ymd_His') . '.csv';

    $headers = [
        "Content-type" => "text/csv",
        "Content-Disposition" => "attachment; filename=$filename",
        "Pragma" => "no-cache",
        "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
        "Expires" => "0"
    ];

    $columns = ['PETSA', 'ARAW', 'ORAS', 'PANGALAN', 'To be Broadcast', 'Lagda'];

    $callback = function() use ($broadcastSuguan, $columns) {
        $file = fopen('php://output', 'w');
        fputcsv($file, $columns);

        foreach ($broadcastSuguan as $entry) {
            $row['Date'] = Carbon::parse($entry->date)->format('F j, Y');
            $row['Day'] = Carbon::parse($entry->date)->format('l');
            $row['Time'] = Carbon::parse($entry->date)->format('g:i A');
            $row['Name'] = $entry->name;
            $row['To be Broadcast'] = $entry->tobebroadcast;
            $row['Lagda'] = $entry->lagda;

            fputcsv($file, [
                $row['Date'], 
                $row['Day'], 
                $row['Time'], 
                $row['Name'], 
                $row['To be Broadcast'], 
                $row['Lagda']
            ]);
        }

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}

public function import(Request $request) 
{
    try {

        $this->validate($request, [
            'import_file' => 'required|file|mimes:csv,txt,xlsx',
        ]);
        Excel::import(new BroadcastSuguanImport, $request->file('import_file'));
        return redirect()->back()->with('success', 'Data imported successfully.');
    } catch (\Exception $e) {
        dd($e);
    }
}

}
