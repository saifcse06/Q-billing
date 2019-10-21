<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
class ClientCustomerGroupPivot extends Model
{
    use SoftDeletes;
    public $table="client_customer_group_pivot";
    protected $fillable=['client_id','customer_id','group_id','status'];
    protected $dates = ['deleted_at'];

    public  function relUser(){
        return $this->belongsTo('App\User','customer_id');
    }
    public function relCustomerGroup(){
        return $this->belongsTo('App\CustomerGroup','group_id');

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
