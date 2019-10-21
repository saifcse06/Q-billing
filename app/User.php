<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','type','parent_id','address','phone','profile_picture','nid','passport','birth_certificate','status','created_by','updated_by'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public  function relClientBusinessType(){
        return $this->hasMany('App\BusinessType','client_id');
    }
    public  function relClientBusinessItems(){
        return $this->hasMany('App\ItemsModel','client_id');
    }

    public function relCustomerGroup(){
        return $this->hasMany('App\CustomerGroup','client_id');
    }

    public  function relInvoice(){
        return $this->hasMany('App\Invoice','client_id');
    }
    /**
     * boot function for created by and updated by
     * */
    public static function boot(){
        parent::boot();
        static::creating(function($query){
            if(Auth::check()){
                $query->created_by = Auth::user()->id;
            }
        });
        static::updating(function($query){
            if(Auth::check()){
                $query->updated_by = Auth::user()->id;
            }
        });
    }
}
