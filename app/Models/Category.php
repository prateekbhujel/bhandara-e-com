<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'status'
    ];

    public function products()
    {
        $this->hasMany(Product::class); //Category belongs to many products
    }
}
