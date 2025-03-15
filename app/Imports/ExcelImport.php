<?php

namespace App\Imports;

use App\Models\Admin\Pincode;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ExcelImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $row)
    {
        unset($row[0]);
        foreach ($row as $value) {
            $pincode = Pincode::where('product_sku', trim($value[2]))->first();
            if (is_null($pincode)) {
                $pincode = new Pincode;
            }
            $pincode->region = $value[1];
            $pincode->pincodes = $value[2];
            $pincode->area = $value[6];
            $pincode->state = $value[7];
            $pincode->estimated_time = $value[18];
            $pincode->save();
        }
    }
}
