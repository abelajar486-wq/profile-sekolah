<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;

class PpdbExport implements FromView, ShouldAutoSize, WithTitle
{
    protected $registrations;

    protected $settings;

    public function __construct($registrations, $settings = [])
    {
        $this->registrations = $registrations;
        $this->settings = $settings;
    }

    public function view(): View
    {
        return view('admin.ppdb.excel', [
            'registrations' => $this->registrations,
            'settings' => $this->settings,
        ]);
    }

    public function title(): string
    {
        return 'Rekap Data PPDB';
    }
}
