<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class RegistrationController extends Controller
{
    //Customer Registration
    public  function  clientRegistration(){
        return view('frontend.registration.create_client');
    }

    public  function saveClientRegistration(Request $request){
        $request->validate([

            'name'=>'required|string',
            'phone'=>'required|unique:users|phone:BD,BE',
            'email'=>'nullable|unique:users|email',
            'password'=>'required|confirmed',
        ]);

        $file = $request->file('profile_picture');
        if($file)
        {
            $finalName= time() . '.' . $file->clientExtension();
            $file->move(public_path('project_files/profile_photo'),$finalName);
        }

        $user=new User();
        $user->name=$request->name;
        $user->type='Client';
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
        $user->password=bcrypt($request->password);
        $user->save();

        Session::flash('message', 'Successfully Save Data,Wait for mail.');
        return redirect()->back();
    }

    //Client Registration
    public  function  customerRegistration(){

        return view('frontend.registration.create_customer');
    }

    public  function saveCustomerRegistration(Request $request){
        $request->validate([

            'name'=>'required|string',
            'phone'=>'required|unique:users|phone:BD,BE',
            'email'=>'nullable|unique:users|email',
            'password'=>'required|confirmed',
        ]);

        $file = $request->file('profile_picture');
        if($file)
        {
            $finalName= time() . '.' . $file->clientExtension();
            $file->move(public_path('project_files/profile_photo'),$finalName);
        }

        $user=new User();
        $user->name=$request->name;
        $user->type='Customer';
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
        $user->password=bcrypt($request->password);
        $user->save();

        Session::flash('message', 'Successfully Save Data,Wait for mail.');
        return redirect()->back();
    }
}
