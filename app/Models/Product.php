<?php

namespace App\Models;

use App\Models\ProductImages;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, softDeletes;
    protected $guarded = ['id'];

    public function category()
    {
       return $this->belongsTo(Category::class, 'category_id', 'id');
    }


    public function productImages()
    {
        return $this->hasMany(productImages::class);
    }
}
