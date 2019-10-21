<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
class BusinessType extends Model
{
    //
    use SoftDeletes;
    public $table="client_business_types";
    protected $fillable=['client_id','name','logo','contact_name','phone_number','email','address','tax','tdr_type','my_tdr','services_tdr','total_tdr','status'];
    protected $dates = ['deleted_at'];

    public  function relUser(){
        return $this->belongsTo('App\User','id');
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
