<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
class CustomerGroup extends Model
{
    use SoftDeletes;
    public $table="customer_groups";
    protected $fillable=['client_id','name','details','status'];
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
