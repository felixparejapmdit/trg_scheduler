<?php
// In the command file
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Music;
use Smalot\PdfParser\Parser;

class ExtractPdfText extends Command
{
    protected $signature = 'extract:pdf-text';
    protected $description = 'Extract text from PDF files and store it in the database';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $parser = new Parser();

        $musics = Music::whereNotNull('lyrics_path')->get();

        foreach ($musics as $music) {
            $pdfPath = storage_path('app/public/' . $music->music_score_path);
//dd($pdfPath);
            if (file_exists($pdfPath)) {
                $pdf = $parser->parseFile($pdfPath);
                $text = $pdf->getText();

                $music->lyrics = $text;
                $music->save();

                $this->info("Extracted text for music ID {$music->id}");
            } else {
                $this->warn("PDF file not found for music ID {$music->id}");
            }
        }
    }
}
