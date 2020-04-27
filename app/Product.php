<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{
    use Notifiable;
    use SoftDeletes;
    //
    protected $fillable = [
        'description','price','wholesale_price','quantity_wholesale_price','stock',
        'image','code','long_description','id_categories','id_units',
    ];

    public function categories()
    {
        return $this->belongsTo(Category::class,'id_categories');
    }

    public function Unit()
    {
        return $this->belongsTo(Unit::class,'id_units');
    }
}
