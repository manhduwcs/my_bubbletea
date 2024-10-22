<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'main_name',
        'category',
        'main_category',
        'size',
        'price',
        'image',
        'popular'
    ];

}
