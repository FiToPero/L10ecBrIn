<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'productName', 
        'shortDescription', 
        'company', 
        'brand', 
        'price', 
        'stock', 
        'priority', 
        'address', 
        'website', 
        'email', 
        'remenber', 
        'image', 
        'image_01',
        'image_02',
        'image_03',
        'image_04',
        'image_05'
    ];

}
