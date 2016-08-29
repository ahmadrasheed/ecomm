<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['imagePath', 'title', 'description', 'price'];

    public function category(){

        return $this->belongsTo(Category::class);
    }


}
