<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    //
    protected $fillable = [
        'category',
    ];

    public function Product()
    {
        return $this->hasMany(Product::class);
    }
}
