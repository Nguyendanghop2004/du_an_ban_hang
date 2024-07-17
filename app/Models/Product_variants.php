<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_variants extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'quantity',
        'image',
        'product_colors_id',
        'product_sizes_id',
        'product_id'
    ];
}
