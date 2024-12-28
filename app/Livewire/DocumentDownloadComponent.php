<?php

namespace App\Livewire;
use Illuminate\Http\Request;
use Livewire\Component;

class DocumentDownloadComponent extends Component
{

    public function downloadPdf($id)
    {
        $filePath = storage_path("app/public/documents/{$id}.pdf");

        if (file_exists($filePath)) {
            return response()->download($filePath);
        }

        return abort(404);
    }

    // public function render()
    // {
    //     return view('livewire.document-download-component');
    // }

}
