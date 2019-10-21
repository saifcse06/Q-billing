<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
class ClientDiscount extends Model
{
    use SoftDeletes;
    public $table="discounts";
    protected $fillable=['client_id','client_business_type_id','title','expire_date','type','value','use','status'];
    protected $dates = ['deleted_at'];

    public  function relUser(){
        return $this->belongsTo('App\User','id');
    }

    public function relBusinessType(){
        return $this->hasOne('App\BusinessType','id','client_business_type_id');
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
