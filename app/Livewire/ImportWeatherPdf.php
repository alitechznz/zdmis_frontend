<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Smalot\PdfParser\Parser;
use App\Models\WeatherData;

class ImportWeatherPdf extends Component
{
    use WithFileUploads;
    public $pdf;
    public $weatherData = [];

    public function render()
    {
        return view('livewire.import-weather-pdf')->layout('layouts.app');
    }

    public function saveData()
    {
        $this->validate([
            'pdf' => 'required|file|mimes:pdf|max:10240', // 10MB Max
        ]);

        $parser = new Parser();
        $pdf    = $parser->parseFile($this->pdf->getRealPath());

        // Extract text from PDF
        $text = $pdf->getText();

        // Example of extracting and parsing the information
        // Regex can vary based on the actual content and format of the PDF
        preg_match('/PEPO ZA PWANI ZINATARAJIWA KUTOKA: (.*?)\s*HALI YA BAHARI/', $text, $winds);
        preg_match('/HALI YA BAHARI ITAKUWA NA MAWIMBI: (.*?)\s*ANGALIZO/', $text, $waves);
        preg_match('/ANGALIZO\s*(.*?)\s*VIWANGO VYA JOTO/', $text, $warnings);
        preg_match_all('/(\w+)\s+(\d+)\s+(\d+)\s+(\d+:\d+)\s+(\d+:\d+)/', $text, $temps, PREG_SET_ORDER);

        // Save extracted data to database
        foreach ($temps as $temp) {
            WeatherData::create([
                'city'          => $temp[1],
                'high_temp'     => $temp[2],
                'low_temp'      => $temp[3],
                'sunrise_time'  => $temp[4],
                'sunset_time'   => $temp[5],
                'wind'          => $winds[1] ?? null,
                'waves'         => $waves[1] ?? null,
                'warnings'      => $warnings[1] ?? null,
            ]);
        }

        // Refresh the $weatherData property to update the front end
        $this->weatherData = WeatherData::latest()->take(10)->get();
    }
}
