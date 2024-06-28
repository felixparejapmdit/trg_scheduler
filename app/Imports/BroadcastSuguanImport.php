<?php

namespace App\Imports;

use App\Models\BroadcastSuguan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BroadcastSuguanImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new BroadcastSuguan([
            'date' => \Carbon\Carbon::parse($row['petsa']),
            'name' => $row['pangalan'],
            'tobebroadcast' => $row['TobeBroadcast'],
        ]);
    }
}
