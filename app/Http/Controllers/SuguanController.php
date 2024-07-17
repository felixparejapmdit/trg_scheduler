<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suguan;

class SuguanController extends Controller
{
    public function index()
    {
        $currentWeek = now()->week;
        $startOfWeek = now()->startOfWeek();
        $endOfWeek = now()->endOfWeek();
    
        $suguan = Suguan::whereBetween('suguan_datetime', [$startOfWeek, $endOfWeek])
                        ->orderBy('suguan_datetime', 'asc')
                        ->paginate(15);
    
        return view('scheduler_management.suguan', compact('suguan', 'currentWeek'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'lokal' => 'required|string',
            'district' => 'required|string',
            'suguan_datetime' => 'required|date',
            'gampanin' => 'required|string',
            'prepared_by' => 'nullable|integer',
            'comments' => 'nullable|string',
        ]);
    
        $districtAcronyms = [
            'Caloocan North' => 'CN',
            'Camanava' => 'CAVA',
            'CENTRAL' => 'CEN',
            'Makati' => 'MAK',
            'MAYNILA' => 'MAY',
            'Metro Manila East' => 'MME',
            'Metro Manila South' => 'MMS',
            'QUEZON CITY' => 'QC',
        ];
    
        $district = array_search($request['district'], $districtAcronyms);
        if ($district) {
            $request['district'] = $district;
        } else {
            // Handle the case when the district is not found in the array
            // For example, you can set a default value or throw an error
            $request['district'] = ''; // or any default value
        }
    
        try {
            Suguan::create($request->all());
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
            'lokal' => 'required|string',
            'edit_district' => 'required|string',
            'suguan_datetime' => 'required|date',
            'gampanin' => 'required|string',
            'prepared_by' => 'nullable|integer',
            'comments' => 'nullable|string',
        ]);
     
        $districtAcronyms = [
            'Caloocan North' => 'CN',
            'Camanava' => 'CAVA',
            'CENTRAL' => 'CEN',
            'Makati' => 'MAK',
            'MAYNILA' => 'MAY',
            'Metro Manila East' => 'MME',
            'Metro Manila South' => 'MMS',
            'QUEZON CITY' => 'QC',
        ];
   
        // Find the key (name) for the district acronym provided in the request
        $districtName = array_search($request['edit_district'], $districtAcronyms);
       
        if ($districtName !== false) {
            // If found, set the district to its full name
            $request['district'] = $districtName;
        } else {
            // Handle the case when the district is not found in the array
            // For example, you can set a default value or throw an error
            $request['district'] = ''; // or any default value
        }
   
        // Update the suguan with the request data
        $suguan->update($request->except('edit_district'));
     // dd($request);
        return redirect()->route('suguan.index')->with('success', 'Suguan updated successfully.');
    }
    

    public function destroy(Suguan $suguan)
    {
        $suguan->delete();

        return redirect()->route('suguan.index')->with('success', 'Suguan deleted successfully.');
    }
}
