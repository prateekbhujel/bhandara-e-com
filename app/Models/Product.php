<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'summary',
        'details',
        'price',
        'discounted_price',
        'category_id',
        'brand_id',
        'images',
        'status',
    ];

    protected $casts = [
        'images' => 'array',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class); //One product has (belongs to) one category relationship.

    }//End Method


    public function brand()
    {
        return $this->belongsTo(Brand::class); //One product has (belongs to) one brand relationship.
        

    }//End Method
}
