<?php

namespace App\Imports;

use App\SupCategories;
use Maatwebsite\Excel\Concerns\ToModel;

class SupCatImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new SupCategories([
            'name'     =>   $row[1],
            'code'     =>   $row[2],
            'cat_code' =>   $row[3],
        ]);
    }
}