<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Mail\CustomerToClient;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;
use Auth;
class AdminController extends Controller
{
    protected $alltypeuserlist;
    public function __construct(User $alltypeuserlist)
    {
        $this->alltypeuserlist=$alltypeuserlist;
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        $data['title']='User lists';
        $all=$this->alltypeuserlist;
        if($request->has('type') && $request->type != null)
        {
            $all=$all->where('type','=',$request->type);
        }
        if($request->has('status') && $request->status != null)
        {
            $all=$all->where('status','=',$request->status);
        }
        if($request->has('name')&& $request->name!=null){
            $all= $all->where('name','like','%' .$request->name. '%');
        }
        if($request->has('phone')&& $request->phone!=null){
            $all= $all->where('phone','=', $request->phone);
        }
        $data['alltypeofuser']=$all->where('email','!=',auth()->user()->email)->paginate(config('system.pagination.items_per_page'));
        $data['serial']=managePagination($data['alltypeofuser']);
        if ($request->ajax()) {
            return view('backend.admin.table_load',$data)->render();
        }

        return view('backend.admin.index',$data);
    }


    public function create()
    {
        $data['title']='Create user';
        return view('backend.admin.create',$data);
    }

    public function store(Request $request)
    {

        $data['customerCheck']=User::where('email',$request->email)->where('phone',$request->phone)->where('type','!=','Client')->where('status','Active')->first();

        if ($data['customerCheck']){

            Session::flash('warning', 'Already Exists');
            return view('backend.admin.create',$data);
           // return redirect()->back()->with(compact('customerCheck'));
            }else{

            $request->validate([
                'type'=>'required',
                'name'=>'required|string',
                'phone'=>'required|unique:users|phone:BD,BE',
                'email'=>'required|nullable|unique:users|email',
                'password'=>'required|confirmed',
                'status'=>'required'
            ]);
            $file = $request->file('profile_picture');
            if($file)
            {
                $finalName= time() . '.' . $file->clientExtension();
                $file->move(public_path('project_files/profile_photo'),$finalName);
            }
            $user=new User();
            $user->name=$request->name;
            $user->type=$request->type;
            $user->nid=$request->nid;
            if(isset($finalName)) {
                $user->profile_picture = $finalName;
            }
            $user->passport=$request->passport;
            $user->birth_certificate=$request->birth_certificate;
            $user->address=$request->address;
            $user->phone=checkPhoneNumber($request->phone);
            $user->email=$request->email;
            $user->status=$request->status;
            $user->password=bcrypt($request->password);
            $user->save();

            Session::flash('message', 'User successfully created.');
            return redirect()->back();
        }


    }

    public function show($id)
    {
        $data['showinfo']=$this->alltypeuserlist->where('id',$id)->first();
        return view('backend.profile.profileInfo',$data);
    }

    public function edit($id)
    {
        $data['title']='Edit user';
        $data['admin']=User::findOrFail($id);
        return view('backend.admin.edit',$data);
    }
    public function update(Request $request,$id)
    {
        $request->validate([
            'type'=>'required',
            'name'=>'required|string',
            'phone'=>'required|phone:BD,BE',
            'email'=>'required|nullable|unique:users|email',
            'status'=>'required'
        ]);

        $user=User::findOrFail($id);

        $file = $request->file('profile_picture');
        if($file)
        {

            $request->validate([
                'profile_picture' => 'required|max:10000|mimes:png,jpeg,png,jpg'
            ]);
            if ($user->profile_picture){
                $file_path = public_path('project_files/profile_photo') . '/' . $user->profile_picture;

                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }


            $finalName= time() . '.' . $file->clientExtension();
            $file->move(public_path('project_files/profile_photo'),$finalName);
        }
        else{

            $finalName=$user->profile_picture;
        }

        $user->name=$request->name;
        $user->type=$request->type;
        $user->nid=$request->nid;
        $user->profile_picture=$finalName;
        $user->passport=$request->passport;
        $user->birth_certificate=$request->birth_certificate;
        $user->status=$request->status;
        $user->updated_by=Auth::user()->id;
        $user->address=$request->address;
        $user->phone=checkPhoneNumber($request->phone);
        $user->email=$request->email;
        $user->save();
        Session::flash('message', 'User successfully updated.');
        return redirect()->back();
    }

    public function changeStatus(Request $req)
    {
        $status= User::find($req->id);
        $status->status=$req->status;
        $status->save();
        return response ()->json ( ['status'=>$status] );
    }

    public function getuserprofile(){
        return view('backend.profile.profileInfo');
    }

    public function customerToClient(Request $request){

        $status= User::find($request->uid);
        $status->type='Client';
        $status->save();
        $data['status']=$status;

        $mailConfig=config('system_mail');
        if ($mailConfig['all']['status'] && $mailConfig['mail']['customer_to_client']) {
            Mail::to($status->email)->send(new CustomerToClient($data));
        }
        Session::flash('message', 'Successfully Convert Customer to Client.');
        return redirect()->back();
    }

}
