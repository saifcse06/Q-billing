<?php

namespace App\Http\Controllers\Backend\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CustomerGroup;
use Auth;
use Illuminate\Support\Facades\Session;

class CustomerGroupController extends Controller
{
    protected  $allcustomergroup;
    public function __construct(CustomerGroup $allcustomergroup)
    {
        $this->allcustomergroup=$allcustomergroup;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['title']="All Items Lists";

        $all=$this->allcustomergroup;

        if($request->has('status') && $request->status != null)
        {
            $all=$all->where('status','=',$request->status);
        }
        if($request->has('name')&& $request->name!=null){
            $all= $all->where('name','like','%' .$request->name. '%');
        }
        $data['allcustomergroup']=$all->where('client_id',Auth::user()->id)->orderBy('id','desc')->paginate(config('system.pagination.items_per_page'));
        $data['serial']=managePagination($data['allcustomergroup']);

        if ($request->ajax()) {
            return view('backend.customer_group.table_load',$data)->render();
        }
        return view('backend.customer_group.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title']="Create Customer Group";
        return view('backend.customer_group.create',$data);
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
            'status'=>'required',
            'name'=>'required',
        ] ) ;
        $cg=new CustomerGroup();
        $cg->client_id=Auth::user()->id;
        $cg->name=$request->name;
        $cg->details=$request->details;
        $cg->status=$request->status;
        $cg->save();

        Session::flash('message','Successfully Create Customer Group');
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
        $data['title']='Update Customer Group';
        $data['cgedit']=$this->allcustomergroup->where('id',$id)->first();
        return view('backend.customer_group.edit',$data);

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
            'status'=>'required',
            'name'=>'required',
        ] ) ;
        $cg=CustomerGroup::findOrFail($id);
        $cg->client_id=Auth::user()->id;
        $cg->name=$request->name;
        $cg->details=$request->details;
        $cg->status=$request->status;
        $cg->save();

        Session::flash('message','Successfully Update Customer Group');
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
        $cg=CustomerGroup::find($id);
        $cg->delete();

        return response()->json(['cg'=>$cg]);
    }

    public  function changeCustomerGroupStatus(Request $request){

        $cg= CustomerGroup::find($request->id);
        $cg->status=$request->status;
        $cg->save();
        return response ()->json ( ['status'=>$cg] );
    }
}
