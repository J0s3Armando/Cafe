<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{
    use Notifiable;
    //
    protected $fillable = [
        'description','price', 'stock','image','code','long_description','id_categories',
    ];

    public function categories()
    {
        return $this->belongsTo(Category::class,'id_categories');
    }
}
