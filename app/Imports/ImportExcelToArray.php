<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

// This is to prevent the import to have slugs for the columns
// HeadingRowFormatter::default('none');

class ImportExcelToArray implements ToArray, WithHeadingRow, WithEvents, WithCalculatedFormulas
{
    public $sheetNames;
    public $sheetData;

    public function __construct(){
        $this->sheetNames = [];
        $this->sheetData = [];
    }
    public function array(array $array)
    {
        $this->sheetData[$this->sheetNames[count($this->sheetNames)-1]] = $array;
    }
    public function registerEvents(): array
    {
        return [
            BeforeSheet::class => function(BeforeSheet $event) {
                $this->sheetNames[] = $event->getSheet()->getTitle();
            } 
        ];
    }
    // public function chunkSize(): int
    // {
    //     return 5;
    // }
    // public function headingRow(): int
    // {
    //     return 6;
    // }
}