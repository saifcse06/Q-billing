<?php

namespace App\Http\Controllers\Backend\Client;

use App\Mail\CustomerCredential;
use App\User;
use Illuminate\Http\Response;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;

class CustomerController extends Controller
{

    //random Password Generate
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

    //common validation Customer add
    protected $rules =
        [
            'name' => 'required|min:3',
            'email'=>'required|unique:users|email',
            'phone'=>'required|unique:users|phone:BD,BE',
            'address' => 'required|min:5',

        ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(Input::all(), $this->rules);

        if ($validator->fails()) {
            return  response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {

            $data['password'] = $this->randomPassword();
            $post = new User();
            $post->type = 'Customer';
            $post->name = $request->name;
            $post->email = $request->email;
            $post->phone = checkPhoneNumber($request->phone);
            $post->address = $request->address;
            $post->status= 'Active';
            $post->password=bcrypt($data['password']);
            $post->save();

            $data['email']=$request->email;
            $data['phone']=$request->phone;
            $data['name']=$request->name;
            $data['client']=auth()->user()->name;
            $data['login_url']=url('/');

            $mailConfig=config('system_mail');
            if ($mailConfig['all']['status'] && $mailConfig['mail']['client_business']) {
                   Mail::to($request->email)->send(new CustomerCredential($data));
            }
            return response()->json($post);
        }
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
        //
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
        //
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
}
