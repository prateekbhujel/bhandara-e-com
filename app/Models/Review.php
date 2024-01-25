<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $guarded = []; //Allows all product to be inserted if its left black kind of opposite of protected $fillable.


    public function product()
    {
        return $this->belongsTo(Product::class);

    }//End Method
    

    public function user()
    {
        return $this->belongsTo(User::class);
        
    }//End Method
}
