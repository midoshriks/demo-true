<?php

namespace App\Imports;

use App\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProductImport implements ToCollection
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection($rows)
    {

        foreach ($rows as $key => $row) {

            $data = [
                'name'     => $row[1],
                'sub_category_code'    => $row[2],
                'purchase_price'    => $row[4],
                'sale_price'    => $row[5],
                'stock'    => $row[6],
                'description'    => $row[9],
                'basic_unit'    => $row[10],
                'pic_no'    => $row[11],
                'sub_unit'    => $row[12],
                'product_code'    => $row[13],
            ];
            // dd($data);
            // dump( $row[13]);
            $product = Product::where('product_code', $row[13])->first();

            if ($product) {
            //     // dd($data);
                 Product::where('product_code', $row[13])->update($data);
            } else {
                // dd('test');
                 Product::create($data);
            }
        }
        // dd($rows);
        // $data = [
        //     'name'     => $row[1],
        //     'sub_category_code'    => $row[2],
        //     'purchase_price'    => $row[4],
        //     'sale_price'    => $row[5],
        //     'stock'    => $row[6],
        //     'description'    => $row[9],
        //     'basic_unit'    => $row[10],
        //     'pic_no'    => $row[11],
        //     'sub_unit'    => $row[12],
        //     'product_code'    => $row[13],
        // ];
        // $product = Product::where('product_code', $row[13])->first();
        // if($product){
        //     // dd($data);
        //     return Product::where('product_code', $row[13])->update($data);
        // }else{
        //     return new Product($data);
        // }
    }
}
