<?php

namespace App\Imports;

use App\Models\BroadcastSuguan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BroadcastSuguanImport implements ToModel, WithHeadingRow
{
     /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $date = \Carbon\Carbon::parse($row['petsa']);
        $time = \Carbon\Carbon::parse($row['oras']);
        $datetime = $date->format('Y-m-d') . ' ' . $time->format('H:i:s');

        
        return new BroadcastSuguan([
            'date' => $datetime ,
            'time' => $row['oras'],
            'name' => $row['pangalan'],
            'tobebroadcast' => $row['broadcast'],
        ]);
    }

      /**
     * @return int
     */
    public function startRow(): int
    {
        return 1; // Start reading from the 2nd row
    }
}
