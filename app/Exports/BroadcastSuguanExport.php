<?php

namespace App\Exports;

use App\Models\BroadcastSuguan;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class BroadcastSuguanExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithCustomStartCell
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return BroadcastSuguan::all();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'PETSA', 
            'ARAW', 
            'ORAS', 
            'PANGALAN', 
            'To be Broadcast', 
            'Lagda'
        ];
    }

    /**
     * @param mixed $broadcastSuguan
     * 
     * @return array
     */
    public function map($broadcastSuguan): array
    {
        return [
            Carbon::parse($broadcastSuguan->date)->format('F j, Y'),
            Carbon::parse($broadcastSuguan->date)->format('l'),
            Carbon::parse($broadcastSuguan->date)->format('g:i A'),
            $broadcastSuguan->name,
            $broadcastSuguan->tobebroadcast,
            $broadcastSuguan->lagda,
        ];
    }

    /**
     * @param Worksheet $sheet
     * 
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        // Adjust column width
        foreach (range('A', 'F') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Set title styles
        $sheet->mergeCells('A1:F1');
        $sheet->setCellValue('A1', 'SUGUAN PARA SA PAGBROADCAST NG TEMPLO WORSHIP SERVICE WEEK 26');
        $sheet->getStyle('A1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 14,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        // Set header styles
        $sheet->getStyle('A2:F2')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => 'BDD6EE',
                ],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);

        // Set alternating row colors and border
        $colors = ['FFF2CC', 'F8CBAD', 'C6E0B4'];
        $currentColorIndex = 0;
        $previousValue = null;
        $totalRows = $sheet->getHighestDataRow();

        for ($rowIndex = 3; $rowIndex <= $totalRows; $rowIndex++) {
            $currentValue = $sheet->getCell('E' . $rowIndex)->getValue();
            if ($currentValue !== $previousValue) {
                $currentColorIndex = ($currentColorIndex + 1) % 3;
            }

            $sheet->getStyle('A' . $rowIndex . ':F' . $rowIndex)->applyFromArray([
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => [
                        'rgb' => $colors[$currentColorIndex],
                    ],
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => '000000'],
                    ],
                ],
            ]);

            $previousValue = $currentValue;
        }

        return [];
    }

    /**
     * @return string
     */
    public function startCell(): string
    {
        return 'A2';
    }
}
