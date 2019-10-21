<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
class SystemSetting extends Model
{
    public $table="system_settings";
    protected $fillable=['type','value','extra','status'];

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
