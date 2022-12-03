<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CsvImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'codigo' => $row[0],
            'articule' => $row[1],
            'pricewithouttax' => $row[2],
            'percenttax' => $row[3],
            'percentliq' => $row[4],
            'partnumber' => $row[8],
            'stocklocal' => $row[9],
            'mark' => $row[12],
            'categoria_id' => $row[13],
            'category' => $row[14],
            'url_image' => $row[15]
       ]);
        
    }
}
