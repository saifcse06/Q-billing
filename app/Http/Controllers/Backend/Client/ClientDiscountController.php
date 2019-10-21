<?php

namespace App\Http\Controllers\Backend\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ClientDiscount;
use App\BusinessType;
use Auth;
use Carbon\Carbon;
use Session;
class ClientDiscountController extends Controller
{

    protected  $alldiscout;
    public function __construct(ClientDiscount $alldiscout)
    {
        $this->alldiscout=$alldiscout;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['title']="Client Discount Lists";

        $all=$this->alldiscout;

        if($request->has('status') && $request->status != null)
        {
            $all=$all->where('status','=',$request->status);
        }
        if($request->has('title')&& $request->name!=null){
            $all= $all->where('title','like','%' .$request->title. '%');
        }
        if ($request->has('client_business_type_id') && $request->client_business_type_id!=null){

            $all= $all->where('client_business_type_id',$request->client_business_type_id);
        }

        $data['alldiscout']= $all->where('client_id',Auth::user()->id)->with('relBusinessType')->orderBy('id','desc')->paginate(config('system.pagination.items_per_page'));
        $data['serial']=managePagination($data['alldiscout']);
        $data['allBusinessType']=BusinessType::where('client_id',Auth::user()->id)->where('status','=','Active')->pluck('name','id');

        if ($request->ajax()) {

            return view('backend.client_discount.table_load',$data)->render();
        }
        return view('backend.client_discount.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title']="Discount Create";
        $data['allBusinessType']=BusinessType::where('client_id',Auth::user()->id)->where('status','=','Active')->pluck('name','id');
        return view('backend.client_discount.create',$data);
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
            'client_business_type_id'=>'required',
            'title'=>'required',
            'type'=>'required',
//            'expire_date'=>'date|after:tomorrow',
            'value'=>'required|numeric|regex:/^\d*(\.\d{1,2})?$/',

        ] ) ;

        if ($request->not_expire_date){
            $expireDate=$request->not_expire_date;
        }else{
            $expireDate=Carbon::parse($request->expire_date)->format('Y-m-d');
        }


        $discount=new ClientDiscount();
        $discount->title=$request->title;
        $discount->expire_date=$expireDate;
        $discount->client_id=Auth::user()->id;
        $discount->client_business_type_id=$request->client_business_type_id;
        $discount->value=$request->value;
        $discount->type=$request->type;
        $discount->status='Unused';
        $discount->save();

        Session::flash('message', 'Discount Successfully Created.');
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
        $data['title']="Discount Update";
        $data['discoutnedit']=$this->alldiscout->where('id',$id)->with('relBusinessType')->first();
        $data['allBusinessType']=BusinessType::where('client_id',Auth::user()->id)->where('status','=','Active')->pluck('name','id');

        return view('backend.client_discount.edit',$data);
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
            'client_business_type_id'=>'required',
            'title'=>'required',
            'type'=>'required',
            'expire_date'=>'required|date|after:tomorrow',
            'value'=>'required|numeric|regex:/^\d*(\.\d{1,2})?$/',

        ] ) ;
        if ($request->not_expire_date){
            $expireDate=$request->not_expire_date;
        }else{
            $expireDate=Carbon::parse($request->expire_date)->format('Y-m-d');
        }
        $discount=ClientDiscount::findOrFail($id);
        $discount->title=$request->title;
        $discount->expire_date=$expireDate;
        $discount->client_id=Auth::user()->id;

        if ($discount->use < 0){

            $discount->client_business_type_id=$request->client_business_type_id;
            $discount->value=$request->value;
            $discount->type=$request->type;

        }else{
            Session::flash('warning', 'Already Using,Value Not Update.');
            return redirect()->back();
        }

        $discount->save();

        Session::flash('message', 'Discount Successfully Update.');
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
        $discount=ClientDiscount::find($id);
        $discount->delete();
        return response()->json(['discount'=>$discount]);
    }

    public  function changeDiscountStatus(Request $request){

        $discount= ClientDiscount::find($request->id);
        $discount->status=$request->status;
        $discount->save();
        return response ()->json ( ['status'=>$discount] );
    }
}
