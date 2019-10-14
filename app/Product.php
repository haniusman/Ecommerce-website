<?php

namespace App;
use App\ProductsImage;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function attributes(){
        return $this->hasMany('App\ProductsAttribute','product_id');
    }

    public function images(){
        return $this->hasMany('App\ProductsImage','product_id');
    }
}
