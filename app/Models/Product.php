<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Product extends Model
{
    use HasFactory; use Translatable;

    protected $guarded = [];
    public $translatedAttributes = ['name','description'];


    public function category(){

        return $this->belongsTo(category::class);
    }

    public function orders(){

        return $this->belongsToMany(Order::class,'product_order');
    }
}
