<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
class Invoice extends Model
{
    use SoftDeletes;
    public $table="invoices";
    protected $fillable=['client_id','customer_id','customer_group_id','client_business_type_id',
        'bundle_id','invoice_no','notification_date','notification_method','publish_date','last_payment_date',
        'subtotal','discount_id','discount_amount','tax','tdr_type','tdr_value','my_tdr','services_tdr','total_tdr','total_amount','note','payment_status','status'];

    protected $dates = ['deleted_at'];

    public  function relUser(){
        return $this->belongsTo('App\User','customer_id');
    }

    public function relBusinessType(){
        return $this->hasOne('App\BusinessType','id','client_business_type_id');
    }

    public  function relInvoiceDetails(){
        return $this->hasMany('App\InvoiceDetails','invoice_id');
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
