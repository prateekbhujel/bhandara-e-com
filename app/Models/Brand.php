<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'status'
    ];
    
    public function products()
    {
        $this->hasMany(Product::class); //Brands belongs to many products
    }
}
