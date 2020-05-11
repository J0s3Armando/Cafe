<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    const PENDING ='PENDING';
    const COMPLITED = 'COMPLITED';
    const CANCELED = 'CANCELED';
    const SEND =100;
    protected $fillable = [
        'id_user','subTotal','send','total','iva',
        'status',
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'id_user');
    }

    public function Products()
    {
        return $this->belongsToMany(Product::class,'order_product','id_order','id_product')->withPivot('id_order','id_product','price_sold','quantity','total');
    }
}
