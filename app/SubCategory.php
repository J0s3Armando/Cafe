<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class SubCategory extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    
    protected $fillable = 
    [
        'description',
    ];
    public function Categories()
    {
        return $this->hasMany(Category::class);
    }
}
