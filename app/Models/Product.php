<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'price',
        'new_price',
        'in_stock',
        'description'
    ];

    public function images() {
        return $this->hasMany(ProductImage::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
