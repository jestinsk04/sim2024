<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ImportHelper implements WithMultipleSheets
{
    public $oSheet;

    public function sheets(): array
    {
        $this->oSheet = new ImportHelperSheet();
        return [
            0 => $this->oSheet
        ];
    }
}