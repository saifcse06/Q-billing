<?php

namespace App\Http\Controllers\Backend\Admin;

use App\BusinessType;
use App\Mail\StatusChangeClientBusiness;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ClientBusinessController extends Controller
{
    protected $allbusinesstype;

    public function __construct(BusinessType $allbusinesstype)
    {
        $this->allbusinesstype = $allbusinesstype;
    }
    //
    public  function clientBusinessList(Request $request,$id){

        $data['title']='Client Business List';
        $all=$this->allbusinesstype->where('client_id',$id);
        if($request->has('type') && $request->type != null)
        {
            $all=$all->where('status','=',$request->type);
        }
        if($request->has('name')&& $request->name!=null)
        {
            $all= $all->where('name','like','%' .$request->name. '%');
        }
        $data['allbusinesstype']= $all->orderBy('id','desc')->paginate(config('system.pagination.items_per_page'));
        $data['serial']=managePagination($data['allbusinesstype']);
        if ($request->ajax())
        {
            return view('backend.admin_client_business.table_load',$data)->render();
        }
        return view('backend.admin_client_business.list_of_client_business',$data);
    }

    public function  changestatus(Request $req){
        $ch= BusinessType::find($req->id);
        $ch->status=$req->status;
        $ch->save();
        $data['business']=$ch;
        $mailConfig=config('system_mail');
        if ($mailConfig['all']['status'] && $mailConfig['mail']['client_business_status']) {
            Mail::to(auth()->user()->email)->send(new StatusChangeClientBusiness($data));
        }
        return response ()->json ( ['status'=>$ch] );
    }
}
