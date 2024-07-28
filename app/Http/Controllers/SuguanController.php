<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suguan;
use Carbon\Carbon;
use App\Models\District; 

use App\Models\LocaleCongregation;

class SuguanController extends Controller
{
    public function index()
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
    
        $suguan = Suguan::with(['district', 'lokal'])
                        ->whereBetween('suguan_datetime', [$startOfWeek, $endOfWeek])
                        ->orderBy('suguan_datetime', 'asc')
                        ->paginate(15);
    
        $districts = District::all();
        $lokals = LocaleCongregation::all();
    
        return view('scheduler_management.suguan', compact('suguan', 'districts', 'lokals'));
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'lokal_id' => 'required|integer',
            'district_id' => 'required|integer',
            'suguan_datetime' => 'required|date',
            'gampanin' => 'required|string',
            'prepared_by' => 'nullable|integer',
            'comments' => 'nullable|string',
        ]);
    
        try {
            Suguan::create($request->only([
                'name',
                'lokal_id',
                'district_id',
                'suguan_datetime',
                'gampanin',
                'prepared_by',
                'comments',
            ]));
            return redirect()->route('suguan.index')->with('success', 'Suguan created successfully.');
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Failed to create Suguan.');
        }
    }
    
public function update(Request $request, Suguan $suguan)
{
    $request->validate([
        'name' => 'required|string',
        'lokal_id' => 'required|integer',  // Correcting from 'edit_lokal' to 'lokal_id'
        'district_id' => 'required|integer',  // Correcting from 'edit_district' to 'district_id'
        'suguan_datetime' => 'required|date',
        'gampanin' => 'required|string',
        'prepared_by' => 'nullable|integer',
        'comments' => 'nullable|string',
    ]);

    // Update the suguan with the request data
    $suguan->update($request->only([
        'name',
        'lokal_id',
        'district_id',
        'suguan_datetime',
        'gampanin',
        'prepared_by',
        'comments',
    ]));

    return redirect()->route('suguan.index')->with('success', 'Suguan updated successfully.');
}
 

    public function destroy(Suguan $suguan)
    {
        $suguan->delete();

        return redirect()->route('suguan.index')->with('success', 'Suguan deleted successfully.');
    }
}
