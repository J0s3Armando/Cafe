<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    const PENDING ='PENDING';
    const COMPLITED = 'COMPLITED';

    public function user()
    {
        return $this->belongsTo(User::class,'id_user');
    }
}
