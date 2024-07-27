<?php

namespace App\Imports;

use App\Models\LocaleCongregation;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LocaleCongregationsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        \Log::info('Row data: ', $row); // Log the row data for debugging

        // Check if 'name' and 'district_id' keys exist in the row
        if (isset($row['name']) && isset($row['district_id'])) {
            // Ensure district_id is an integer
            $districtId = (int) $row['district_id'];

            return new LocaleCongregation([
                'name' => $row['name'],
                'district_id' => $districtId,
            ]);
        }

        // Log if keys are missing
        \Log::warning('Missing keys in row: ', $row);
        return null;
    }
}
