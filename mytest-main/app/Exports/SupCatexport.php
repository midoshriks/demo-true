<?php

namespace App\Exports;

use App\SupCategories;
use Maatwebsite\Excel\Concerns\FromCollection;

class SupCatexport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return SupCategories::all();
    }
}
