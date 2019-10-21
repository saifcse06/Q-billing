<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TransactionsModel extends Model
{
    public $table="transactions";
    protected $fillable=['tran_id','store_id','invoice_id','client_id','customer_id','payment_amount','payment_date','gateway_data','status'];

    public  function relUser(){
        return $this->belongsTo('App\User','customer_id');
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
