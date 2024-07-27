<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\LocaleCongregationsImport;

use App\Models\LocaleCongregation;

class LocaleCongregationImportController extends Controller
{
    public function import(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:xlsx'
        ]);

        try {
            // Log the file upload details
            \Log::info('File upload: ', ['file' => $request->file('file')->getClientOriginalName()]);

            // Import the file
            Excel::import(new LocaleCongregationsImport, $request->file('file'));

            return redirect()->route('suguan.index')->with('success', 'Locale Congregations imported successfully.');
        } catch (\Exception $e) {
            \Log::error('Import error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to import Locale Congregations.');
        }
    }

     public function getLokals($districtId)
    {
      
        $lokals = LocaleCongregation::where('district_id', $districtId)->pluck('name', 'id');
        return response()->json($lokals);
    }
}
