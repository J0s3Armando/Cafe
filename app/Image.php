<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use SoftDeletes;
    const CAROUSEL ='CAROUSEL';
    const GALERY = 'GALERY';
    use SoftDeletes;
    protected $fillable = [
    'title','description','image','type',
   ];
}
