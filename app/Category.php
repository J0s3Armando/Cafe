<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    //
    use SoftDeletes;
    
    protected $fillable = [
        'category','id_SubCategory',
    ];

    public function Product()
    {
        return $this->hasMany(Product::class,'id_categories');
    }

    public function Subcategory()
    {
        return $this->belongsTo(SubCategory::class,'id_SubCategory');
    }
}
