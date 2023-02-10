<?php

namespace App\Imports;

use App\Http\Requests\Request;
use Fanky\Admin\Models\ProductTest;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMappedCells;
use PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing;

class LightsImport implements ToModel {
    public function model(array $row)
    {
        return new ProductTest([
            'name'     => $row[0],
            'email'    => $row[1],
        ]);
    }
}
