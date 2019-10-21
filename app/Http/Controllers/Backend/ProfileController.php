<?php

namespace App\Http\Controllers\Backend;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class ProfileController extends Controller
{
    //
    public  function showProfile(){
        $data['title']="Client Profile Update";
        $data['showinfo']=User::where('id',auth()->user()->id)->where('status','Active')->first();

        return view('backend.profile.show_profile',$data);
    }

    public  function editClientProfile($id){
        $data['showinfo']=User::where('id',$id)->where('status','Active')->first();
        return view('backend.profile.edit_profile',$data);
    }

    public function updateClientProfile(Request $request,$id){

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
        $user->nid=$request->nid;
        $user->profile_picture=$finalName;
        $user->passport=$request->passport;
        $user->birth_certificate=$request->birth_certificate;
        $user->updated_by=Auth::user()->id;
        $user->address=$request->address;
        $user->save();
        Session::flash('message', 'Successfully updated.');
        return redirect()->back();
    }

}
