<?php

namespace App\Http\Controllers\Backend\Client;

use App\Mail\EmployeeCredential;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Session;
class EmployeeManageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $allEmployee;

    public function __construct(User $allEmployee)
    {
        $this->allEmployee=$allEmployee;

    }

    public function index(Request $request)
    {

        $data['title']='List of Employee';
        $all=$this->allEmployee;

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
        $data['all_employee']=$all->where('type','Employee')->where('parent_id',auth()->user()->id)->paginate(config('system.pagination.items_per_page'));
        $data['serial']=managePagination($data['all_employee']);
        if ($request->ajax()) {
            return view('backend.employee.table_load',$data)->render();
        }

        return view('backend.employee.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title']='Create Employee';
     return view('backend.employee.create',$data);
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
            'name'=>'required|string',
            'phone'=>'required|unique:users|phone:BD,BE',
            'email'=>'nullable|unique:users|email'

        ]);

         $file = $request->file('profile_picture');
        if($file)
        {
            $finalName= time() . '.' . $file->clientExtension();
            $file->move(public_path('project_files/profile_photo'),$finalName);
        }

        if (auth()->user()->type=='Client'){
            $pid=auth()->user()->id;
        }elseif (auth()->user()->type=='Employee'){
            $pid=auth()->user()->parent_id;
        }
        $data['password'] = $this->randomPassword();
        $user=new User();
        $user->name=$request->name;
        $user->parent_id=$pid;
        $user->type='Employee';
        $user->nid=$request->nid;
        if(isset($finalName)) {
            $user->profile_picture = $finalName;
        }
        $user->passport=$request->passport;
        $user->birth_certificate=$request->birth_certificate;
        $user->address=$request->address;
        $user->phone=checkPhoneNumber($request->phone);
        $user->email=$request->email;
        $user->status='Pending';
        $user->password=bcrypt($data['password']);
        $user->save();

        $data['email']=$request->email;
        $data['phone']=$request->phone;
        $data['name']=$request->name;
        $data['client']=auth()->user()->name;
        $data['login_url']=url('/employee/active',$user->id);

        $mailConfig=config('system_mail');
        if ($mailConfig['all']['status'] && $mailConfig['mail']['employee_credential']) {
         Mail::to($request->email)->send(new EmployeeCredential($data));
        }
        Session::flash('message', 'Employee successfully created.');
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
         $data['title']="Employee Profile";
         $data['showinfo']=User::where('id',$id)->where('parent_id',auth()->user()->id)->first();
        return view('backend.employee.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['title']="Employee Profile Update";
        $data['update_info']=User::where('id',$id)->where('parent_id',auth()->user()->id)->first();
        return view('backend.employee.edit',$data);
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

            'name'=>'required|string',
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
        $user->type='Employee';
        $user->nid=$request->nid;
        $user->profile_picture=$finalName;
        $user->passport=$request->passport;
        $user->birth_certificate=$request->birth_certificate;
        $user->updated_by=auth()->user()->id;
        $user->address=$request->address;
        $user->save();
        Session::flash('message', 'Employee successfully updated.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public  function changeStatus(Request $req){
        $status= User::find($req->id);
        $status->status=$req->status;
        $status->save();
        return response ()->json ( ['status'=>$status] );
    }
    public  function  employeeActive($id){
        $status= User::find($id);
        $status->status='Active';
        $status->save();
        Session::flash('message', 'Successfully Active Please Login.');
        return redirect('login');
    }
    protected function randomPassword($length = 6, $result='') {

        for($i = 0; $i < $length; $i++) {

            $case = mt_rand(0, 1);
            switch($case){

                case 0:
                    $data = mt_rand(0, 9);
                    break;
                case 1:
                    $alpha = range('a','z');
                    $item = mt_rand(0, 9);

                    $data = strtoupper($alpha[$item]);
                    break;
            }

            $result .= $data;
        }

        return $result;
    }
}
