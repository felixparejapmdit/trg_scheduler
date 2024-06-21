<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suguan;

class SuguanController extends Controller
{
    public function index()
    {
        $suguan = Suguan::all();
        return view('scheduler_management.suguan', compact('suguan'));
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
            $request['district'] = $districtAcronyms[$request['district']];
        } else {
            // Handle the case when the district is not found in the array
            // For example, you can set a default value or throw an error
            $request['district'] = ''; // or any default value
        }
    
        $suguan->update($request->all());
    
        return redirect()->route('suguan.index')->with('success', 'Suguan updated successfully.');
    }

    public function destroy(Suguan $suguan)
    {
        $suguan->delete();

        return redirect()->route('suguan.index')->with('success', 'Suguan deleted successfully.');
    }
}
