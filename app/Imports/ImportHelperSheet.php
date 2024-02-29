<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportHelperSheet implements ToModel, WithHeadingRow
{
    public $aDataProcess = array();

    public function model(array $aRow)
    {
        // Handle the data in $aRow and insert the modified object inside the $aDataProcess property and return null
        return null;
    }

    public function getDataProcess(): array
    {
        return $this->aDataProcess;
    }
}