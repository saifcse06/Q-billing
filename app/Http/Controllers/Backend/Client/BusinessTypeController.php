<?php

namespace App\Http\Controllers\Backend\Client;

use App\Mail\CreateClientBusiness;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BusinessType;
use Auth;
use Illuminate\Support\Facades\Mail;
use League\Flysystem\Config;
use Session;



class BusinessTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     */
    protected $allbusinesstype;

    public function __construct(BusinessType $allbusinesstype)
    {
        $this->allbusinesstype = $allbusinesstype;
    }

    public function index(Request $request)
    {

        $data['title']="Client Business Type Lists";
        $all=$this->allbusinesstype;
        if($request->has('type') && $request->type != null)
        {
            $all=$all->where('status','=',$request->type);
        }
        if($request->has('name')&& $request->name!=null)
        {
            $all= $all->where('name','like','%' .$request->name. '%');
        }
        $data['allbusinesstype']= $all->where('client_id',auth()->user()->id)->orderBy('id','desc')->where('status','!=','Rejected')->paginate(config('system.pagination.items_per_page'));
        $data['serial']=managePagination($data['allbusinesstype']);

        if ($request->ajax())
        {
            return view('backend.client_business_type.table_load',$data)->render();
        }
        return view('backend.client_business_type.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.client_business_type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      $request->validate([
            'name'=>'required',
            'contact_name'=>'required',
            'logo'=>'max:10000|mimes:png,jpeg,png,jpg',
            'phone_number'=>'phone:BD,BE',
            'email'=>'required|nullable|email',
            'address'=>'required',
            'tax'=>'required|numeric|between:0,99.99',
            'tdr_type'=>'required',
            'my_tdr'=>'required',
            'services_tdr'=>'required',
            'total_tdr'=>'required',

        ] ) ;
        $file = $request->file('logo');
        if($file)
        {
            $finalName= time() . '.' . $file->clientExtension();
            $file->move(public_path('project_files/client_logo'),$finalName);
        }else{
            $finalName=null;
        }
        $businesstype=new BusinessType();
        $businesstype->name=$request->name;
        $businesstype->contact_name=$request->contact_name;
        $businesstype->logo=$finalName;
        $businesstype->phone_number=checkPhoneNumber($request->phone_number);
        $businesstype->email=$request->email;
        $businesstype->address=$request->address;
        $businesstype->tax=$request->tax;
        $businesstype->tdr_type=$request->tdr_type;
        $businesstype->my_tdr=$request->my_tdr;
        $businesstype->services_tdr=$request->services_tdr;
        $businesstype->total_tdr=$request->total_tdr;
        $businesstype->client_id=Auth::user()->id;
        $businesstype->status='Pending';
        $businesstype->save();
        //all admin mail send for client create new business type
        $allAdminMail=[];
        $adminEmail=User::where('type','Admin')->where('status','=','Active')->get();
        foreach ($adminEmail as $v){
            $allAdminMail[]=$v->email;
        }

        $data['client']=User::where('id',auth()->user()->id)->first();
        $data['business']=$businesstype;

        $mailConfig=config('system_mail');

        if ($mailConfig['all']['status'] && $mailConfig['mail']['client_business']) {
            Mail::to($allAdminMail)->send(new CreateClientBusiness($data));
        }

        Session::flash('message', 'Client Business Type Successfully Created.');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['clientbusiness']=BusinessType::where('id',$id)->first();
        return view('backend.client_business_type.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required',
            'contact_name'=>'required',
            'phone_number'=>'required|phone:BD,BE',
            'email'=>'required|email',
            'address'=>'required',
            'tax'=>'required|numeric|between:0,99.99',
            'tdr_type'=>'required',
            'my_tdr'=>'required',
            'services_tdr'=>'required',
            'total_tdr'=>'required',

        ]);

        $file = $request->file('logo');
        $businesstype=BusinessType::findOrFail($id);
        if($file)
        {
            $request->validate([
                'logo' => 'max:10000|mimes:png,jpeg,png,jpg'
            ]);
            $file_path = public_path('project_files/client_logo') . '/' . $businesstype->logo;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $finalName= time() . '.' . $file->clientExtension();
            $file->move(public_path('project_files/client_logo'),$finalName);
        }
        else{
            $finalName=$businesstype->logo;
        }
        $businesstype->name=$request->name;
        $businesstype->contact_name=$request->contact_name;
        $businesstype->logo=$finalName;
        $businesstype->phone_number=checkPhoneNumber($request->phone_number);
        $businesstype->email=$request->email;
        $businesstype->address=$request->address;
        $businesstype->tax=$request->tax;
        $businesstype->tdr_type=$request->tdr_type;
        $businesstype->my_tdr=$request->my_tdr;
        $businesstype->services_tdr=$request->services_tdr;
        $businesstype->total_tdr=$request->total_tdr;
        $businesstype->client_id=Auth::user()->id;
        $businesstype->save();
        Session::flash('message', 'Business Type  Successfully Update.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $businesstype=BusinessType::find($id);
        $businesstype->delete();
        return response()->json(['businesstype'=>$businesstype]);
    }



}
