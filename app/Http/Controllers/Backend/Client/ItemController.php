<?php

namespace App\Http\Controllers\Backend\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ItemsModel;
use App\BusinessType;
use Auth;
use Session;
class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $allItemsLists;

    public function __construct(ItemsModel $allItemsLists)
    {
        $this->allItemsLists = $allItemsLists;
    }

    public function index(Request $request)
    {

        $data['title']="All Items Lists";

        $all=$this->allItemsLists;
        if($request->has('status') && $request->status != null)
        {
            $all=$all->where('status','=',$request->status);
        }
        if($request->has('name')&& $request->name!=null){
            $all= $all->where('name','like','%' .$request->name. '%');
        }
        if($request->has('business_type_id')&& $request->business_type_id!=null){
            $all= $all->where('business_type_id','=',$request->business_type_id);
        }

        $data['allItemsLists']=$all->where('client_id',Auth::user()->id)->with('relBusinessType')->orderBy('id','desc')->paginate(config('system.pagination.items_per_page'));

        $data['serial']=managePagination($data['allItemsLists']);
        $data['allBusinessType']=BusinessType::where('client_id',Auth::user()->id)->where('status','=','Active')->pluck('name','id');
        if ($request->ajax()) {
            return view('backend.items.table_load',$data)->render();
        }
        return view('backend.items.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title']="Create Item";
        $data['allBusinessType']=BusinessType::where('client_id',Auth::user()->id)->where('status','=','Active')->pluck('name','id');
        return view('backend.items.create',$data);
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
            'business_type_id'=>'required',
            'name'=>'required',
            'price'=>'required|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'status'=>'required'
        ] ) ;

        $item=new ItemsModel();
        $item->name=$request->name;
        $item->client_id=Auth::user()->id;
        $item->business_type_id=$request->business_type_id;
        $item->price=$request->price;
        $item->details=$request->details;
        $item->status=$request->status;
        $item->save();

        Session::flash('message', 'Item Successfully Created.');
        return redirect()->back()->withInput($request->only('business_type_id'));
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
        $data['title']="Edit Item";
        $data['itemedit']=$this->allItemsLists->where('id',$id)->first();
        $data['allBusinessType']=BusinessType::where('status','=','Active')->where('client_id',Auth::user()->id)->pluck('name','id');
        return view('backend.items.edit',$data);
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
            'business_type_id'=>'required',
            'name'=>'required',
            'price'=>'required|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'status'=>'required'
        ] ) ;

        $item=ItemsModel::findOrFail($id);
        $item->name=$request->name;
        $item->client_id=Auth::user()->id;
        $item->business_type_id=$request->business_type_id;
        $item->price=$request->price;
        $item->details=$request->details;
        $item->status=$request->status;
        $item->save();

        Session::flash('message', 'Item Successfully Update.');
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
        $item=ItemsModel::find($id);
        $item->delete();
        return response()->json(['item'=>$item]);
    }

    public function itemStatusChange(Request $request)
    {
        $item= ItemsModel::find($request->id);
        $item->status=$request->status;
        $item->save();
        return response ()->json ( ['status'=>$item] );
    }
}
