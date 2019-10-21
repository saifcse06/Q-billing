<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
class InvoiceDetails extends Model
{
    use SoftDeletes;
    public $table="invoice_details";
    protected $fillable=['invoice_id','item_id','client_business_type_id','item_name',
        'quantity','unit_price','total_amount'];
    public $timestamps = false;

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
//    public static function boot(){
//        parent::boot();
//        static::creating(function($query){
//            if(Auth::check()){
//                $query->created_by = Auth::user()->id;
//            }
//        });
//        static::updating(function($query){
//            if(Auth::check()){
//                $query->updated_by = Auth::user()->id;
//            }
//        });
//    }
}
