<?php

namespace App\Http\Controllers\Backend\Admin;

use App\BusinessType;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminReportsController extends Controller
{
    protected $allbusinesstype;

    public function __construct(BusinessType $allbusinesstype,User $allClients)
    {
        $this->allbusinesstype = $allbusinesstype;
        $this->allClients=$allClients;
    }
    //
    public function allClientInfoReport(Request $request){
        $data['title']="Client Summery";

        $all=$this->allClients;

        if($request->has('status') && $request->status != null)
        {
            $all=$all->where('status','=',$request->status);
        }
        if($request->has('name')&& $request->name!=null)
        {
            $all= $all->where('name','like','%' .$request->name. '%');
        }

        $data['allClientInfo']=$all->with(['relClientBusinessType','relClientBusinessItems','relCustomerGroup','relInvoice'])->where('type','Client')->paginate(config('system.pagination.items_per_page'));

        $data['serial']=managePagination($data['allClientInfo']);
        if ($request->ajax())
        {
            return view('backend.admin_reports._client_table',$data)->render();
        }
        return view('backend.admin_reports.clients_info_reports',$data);
    }

    public  function allClientBusiness(Request $request,$id){
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
            return view('backend.admin_reports._client_business_table_load',$data)->render();
        }
        return view('backend.admin_reports.clients_info_reports',$data);
    }

    public  function allClientInvoice(){

    }
}
