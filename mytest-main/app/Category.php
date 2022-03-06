<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // use \Dimsav\Translatable\Translatable;

    // protected $guarded = [];
    protected $fillable = ['name','code'];

    // protected $table  = 'categories';

    // public $translatedAttributes = ['name'];

    public function products()
    {
        return $this->hasMany(Product::class);

    }//end of products

}//end of model