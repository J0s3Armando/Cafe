<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    public function autorize($roles)
    {
       if( $this->hasAnyRoles($roles))
       {
            return true;
       }
       return false;
    }

    public function hasAnyRoles($roles)
    {
        if(is_array($roles))
        {
           foreach ($roles as $role) {
                if($this->hasRole($role))
                {
                    return true;
                }
           }
        }
        else{
            if($this->hasRole($roles))
            {
                return true;
            }
        }
        return false;
    }

    public function hasRole($role)  // $role is integer references to db
    {
        if($this->idRole == $role)
        {
            return true;
        }
        return false;
    }

    public function roles()
    {
        return $this->belongsTo(Role::class,'idRole');
    }

    public function Orders()
    {
        return $this->hasMany(Order::class,'id_user');
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','last_name', 'address','cp','phone','idRole','email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
