<?php

namespace App\Http\Controllers\Backend\Client;

use App\ClientCustomerGroupPivot;
use App\CustomerGroup;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ClientCustomerGroupPivotController extends Controller
{
    protected $allClientCustomerGroupPivot;

    public function __construct(ClientCustomerGroupPivot $allClientCustomerGroupPivot)
    {
        $this->allClientCustomerGroupPivot = $allClientCustomerGroupPivot;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['title'] = "Client Customer Group Pivot";
        $all = $this->allClientCustomerGroupPivot;
        if ($request->has('status') && $request->status != null) {
            $all = $all->where('status', '=', $request->status);
        }
        if ($request->has('group_id') && $request->group_id != null) {
            $all = $all->where('group_id', $request->group_id);
        }
        $data['clientCustomerGroupPivot'] = $all->where('client_id', Auth::user()->id)->orderBy('id', 'desc')->with(['relUser', 'relCustomerGroup'])->paginate(config('system.pagination.items_per_page'));
        $data['serial'] = managePagination($data['clientCustomerGroupPivot']);
        $data['allcustomergroup'] = CustomerGroup::where('client_id', Auth::user()->id)->where('status', '=', 'Active')->pluck('name', 'id');
        if ($request->ajax()) {
            return view('backend.clientCustomerGroupPivot.table_load', $data)->render();
        }
        return view('backend.clientCustomerGroupPivot.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = "Create Client Customer Group Pivot";
        $data['alluser'] = User::where('status', '=', 'Active')->select('id', DB::raw("concat(phone, ' (<i>', name,'</i>)') as name_phone"))->pluck('name_phone', 'id');
        $data['allcustomergroup'] = CustomerGroup::where('client_id', Auth::user()->id)->where('status', '=', 'Active')->pluck('name', 'id');
        return view('backend.clientCustomerGroupPivot.create', $data);
    }

    public function ajaxSearchUserByMobileNumber(Request $request)
    {
        $user=User::where('status', '=', 'Active');
        $user=$user->where('phone','like',checkPhoneNumber($request->q).'%');
        return $user->select('id', DB::raw("concat(phone, ' (', name,')') as name_phone"))->get();
//        return response()->json($user->pluck('phone', 'id'));
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
            'group_id'=>'required',
            'customer_id'=>'required'
        ]);
        foreach($request->customer_id as $customer_id){
            $validity=ClientCustomerGroupPivot::where(['client_id'=>auth()->id(),'group_id'=>$request->group_id,'customer_id'=>$customer_id])->first();

            if(count($validity)==0) {
                $cg = new ClientCustomerGroupPivot();
                $cg->client_id = Auth::user()->id;
                $cg->group_id = $request->group_id;
                $cg->status = 'Active';
                $cg->customer_id = $customer_id;
                $cg->save();
            }else
            {
                // For activate Inactive contacts
                if($validity->status=='Inactive')
                {
                    $validity->status='Active';
                    $validity->update();
                }
            }
        }

        Session::flash('message','Successfully Create Customer Group');
        return redirect()->back(); //
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
        $client_cg=ClientCustomerGroupPivot::find($id);
        $client_cg->delete();

        return response()->json(['client_cg'=>$client_cg]);
    }

    public  function changeStatus(Request $request){

        $client_cg= ClientCustomerGroupPivot::find($request->id);
        $client_cg->status=$request->status;
        $client_cg->save();
        return response ()->json ( ['status'=>$client_cg] );
    }
}
