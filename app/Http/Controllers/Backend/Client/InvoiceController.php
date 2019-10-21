<?php

namespace App\Http\Controllers\Backend\Client;

use App\BusinessType;
use App\ClientCustomerGroupPivot;
use App\ClientDiscount;
use App\CustomerGroup;
use App\Invoice;
use App\InvoiceDetails;
use App\ItemsModel;
use App\Mail\InvoiceInfo;
use App\Notifications;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Mail\SendMailable;
class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $allInvoiceLists;

    public function __construct(Invoice $allInvoiceLists)
    {
        $this->allInvoiceLists = $allInvoiceLists;
    }

    public function index(Request $request)
    {
        $data['title']="All Invoice Lists";

        $all=$this->allInvoiceLists;

        if($request->has('payment_status') && $request->status != null)
        {
            $all=$all->where('payment_status','=',$request->status);
        }

        $data['allInvoiceLists']=$all->with('relUser','relBusinessType')->where('client_id', Auth::user()->id)->paginate(config('system.pagination.items_per_page'));
        $data['serial']=managePagination($data['allInvoiceLists']);
//dd($data['allInvoiceLists']);
        $data['allBusinessType']=BusinessType::where('client_id',Auth::user()->id)->where('status','=','Active')->pluck('name','id');
        if ($request->ajax()) {
            return view('backend.invoice.table_load',$data)->render();
        }
        return view('backend.invoice.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $data['all_business_type'] = BusinessType::where('client_id', Auth::user()->id)->where('status', '=', 'Active')->pluck('name', 'id');
        $data['all_customer_group']=CustomerGroup::where('client_id', Auth::user()->id)->where('status', '=', 'Active')->pluck('name', 'id');
        return view('backend.invoice.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //dd(Carbon::parse($request->publish_date)->format('Y-m-d H:i'));
        $request->validate([
            // 'start_date'    => 'required|date',
            'client_business_type_id'=>'required',
            'publish_date'=>'required|date',
            'last_payment_date'=>'required|date|after:start_date',
            'notification_date'=>'required|date|after:start_date',
            'notification_method'=>'required',
            'c_type'=>'required',
            'items.*.item_id'=>'required',
            'items.*.quantity'=>'required|numeric',
            'items.*.unit_price'=>'required|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'items.*.total_amount'=>'required|numeric|regex:/^\d*(\.\d{1,2})?$/'

        ] ) ;

        $publishDate=Carbon::parse($request->publish_date);
        $lastPaymentDate=Carbon::parse($request->last_payment_date);
        $notificationDate=Carbon::parse($request->notification_date);

        if($publishDate > $lastPaymentDate){

            // Session::flash('message', 'Last Payment Date Greater Published Date .');
            return back()->withInput()->withErrors('Last Payment Date Greater Published Date .');
        }
        if ($publishDate > $notificationDate || $notificationDate > $lastPaymentDate){

            // Session::flash('message', 'Notification Date Greater Than Publish Date And Less Than Last Payment Date.');
            return back()->withInput()->withErrors('Notification Date Greater Than Publish Date And Less Than Last Payment Date.');
        }


        $customer_invoices=[];
        $allItems= [];
        $invoice_details = collect($request->all());

        if ($request->c_type=="single"){
            $customers=User::whereIn('id', $invoice_details['customer_id'])->where('status','=','Active')->get();
        }
        if ($request->c_type=="group"){
            $customers=ClientCustomerGroupPivot::with('relUser')->where('group_id', $invoice_details['customer_group_id'])->get();
        }

        $business_type= BusinessType::select('name', 'id', 'client_id', 'tax','tdr_type','my_tdr','services_tdr','total_tdr','logo')->where('id', $invoice_details['client_business_type_id'])->where('client_id', Auth::user()->id)->first();
        $discount= ClientDiscount::where('status', '!=', 'Used')->where('id', $invoice_details['discount_id'])->where('client_id', Auth::user()->id)->first();

        if (count($invoice_details['items']) > 0) {
            foreach ($invoice_details['items'] as $k => $v) {
                //$data['items_details'][] = ItemsModel::where('id', $v['item_id'])->first();
                $allItems[]=ItemsModel::where('id', $invoice_details['items'][$k]['item_id'])->first();
            }
        }

        if (count($customers)==0){
            return back()->withInput()->withErrors('User Group user not define');
        }else{
            foreach ($customers as $customer) {
                if($request->c_type=="group"){$c_info=$customer->relUser;}
                if($request->c_type=="single"){$c_info=$customer;}
                $customer_invoices[$c_info->id]['customer_info']=$c_info;
                $customer_invoices[$c_info->id]['invoice_details']=$invoice_details;
                $customer_invoices[$c_info->id]['invoice_no']='QB'.time().rand(0,9);
                $customer_invoices[$c_info->id]['invoice_details']['item_all']=$allItems;
                $customer_invoices[$c_info->id]['discount']=$discount;
                $customer_invoices[$c_info->id]['business_type']=$business_type;

            }
        }


        //   $request->session()->forget('invoice');
        Session::put('invoice', $customer_invoices);
        return redirect()->route('invoice_preview');
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

    public  function getdiscountlistbybusinesstype(Request $request){

        if($request->ajax()){

            $states= ClientDiscount::where('status', '!=', 'Used')->where('client_id', Auth::user()->id)->where('client_business_type_id',$request->client_business_type_id)->select("title","id","type","value")->get();
            $items  =ItemsModel::where('status','Active')->where('client_id', Auth::user()->id)->where('business_type_id',$request->client_business_type_id)->select("name","id","price")->get();

            $data = view('backend.invoice.ajax-discount-list',compact('states'))->render();
            $item = view('backend.invoice.ajax-items-list',compact('items'))->render();

            return response()->json(['options'=>$data,'items'=>$item]);
        }
    }

    public function getAllInvoicePreview(){
        $data['invoiceDetails'] = Session::get('invoice');
        if (!$data['invoiceDetails']){
            return redirect()->route('invoice.create');
        }
        return view( 'backend.invoice._invoicePreviewModal',$data);
    }

    public function getEditInvoice(Request $request,$id){
        $data['invoiceDetails'] = Session::get('invoice');
        $data['discount_list']= ClientDiscount::where('status', '!=', 'Used')->where('client_business_type_id',$request->business_type)->where('client_id', Auth::user()->id)->select("title","id","type","value")->get();
        $data['all_items']  =ItemsModel::where('status','Active')->where('client_id', Auth::user()->id)->where('business_type_id',$request->business_type)->select("name","id","price")->get();
        $data['user']=User::where('id',$id)->where('status','=','Active')->first();
        $data['client_business_type_id']=$request->business_type;
        return view('backend.invoice.edit_invoice_preview',$data);
    }


    public function updatePreviewInvoice(Request $request){

        $invoice_details = collect($request->all());
        if (count($invoice_details['items']) > 0) {
            foreach ($invoice_details['items'] as $k => $v) {
                $allItems[]=ItemsModel::where('id', $invoice_details['items'][$k]['item_id'])->first();
            }
        }
        $sessionInvoiceDetails = Session::get('invoice');
        $discount= ClientDiscount::where('status', '!=', 'Used')->where('id', $invoice_details['discount_id'])->where('client_id', Auth::user()->id)->first();
        $business_type= BusinessType::select('name', 'id', 'client_id', 'tax','tdr_type','my_tdr','services_tdr','total_tdr')->where('id', $invoice_details['client_business_type_id'])->where('client_id', Auth::user()->id)->first();

        $sessionInvoiceDetails[$request->customer_id]['invoice_details']=$invoice_details;
        $sessionInvoiceDetails[$request->customer_id]['invoice_details']['item_all']=$allItems;
        $sessionInvoiceDetails[$request->customer_id]['discount']=$discount;
        $sessionInvoiceDetails[$request->customer_id]['business_type']=$business_type;

        Session::put('invoice',$sessionInvoiceDetails);
        Session::flash('message', 'Individual Invoice Successfully Update.');
        return redirect()->route('invoice_preview');
    }


    public  function saveAllInvoiceFromSession(Request $request){
        $sessionInvoiceDetails = Session::get('invoice');

        DB::beginTransaction();
        try {
            foreach ($sessionInvoiceDetails as $k=>$v){

                $subTotalAmount=(int)$v['invoice_details']['total_amount'];
                $discoutAmout=ClientDiscount::where('id',$v['invoice_details']['discount_id'])->first();

                if ($discoutAmout){
                    $totalDiscount=$this->_totalDiscoutAmount($subTotalAmount,$discoutAmout->type,$discoutAmout->value);
                }else{
                    $totalDiscount=0;
                }

                $businessTpeValue=BusinessType::where('id',$v['invoice_details']['client_business_type_id'])->first();

                if ($businessTpeValue->tdr_type=="Percentage"){
                    $tdrValue=(($subTotalAmount+$this->_taxCalculate($subTotalAmount,$businessTpeValue->tax)-$totalDiscount)*($businessTpeValue->my_tdr+$businessTpeValue->services_tdr)/100);
                }elseif ($businessTpeValue->tdr_type=="Fixed"){
                    $tdrValue=($businessTpeValue->my_tdr+$businessTpeValue->services_tdr);
                }

                $totalAmount=($subTotalAmount+$this->_taxCalculate($subTotalAmount,$businessTpeValue->tax)+$tdrValue-$totalDiscount);

                $invoice=new Invoice();
                $invoice->client_id=Auth::user()->id;
                $invoice->customer_id=$v['customer_info']['id'];
                $invoice->customer_group_id=$v['invoice_details']['customer_group_id'];
                $invoice->client_business_type_id=$v['invoice_details']['client_business_type_id'];
                $invoice->invoice_no=$v['invoice_no'];
                $invoice->notification_date=Carbon::parse($v['invoice_details']['notification_date'])->format('Y-m-d H:i');
                $invoice->notification_method=$v['invoice_details']['notification_method'];
                $invoice->publish_date=Carbon::parse($v['invoice_details']['publish_date'])->format('Y-m-d H:i');;
                $invoice->last_payment_date=Carbon::parse($v['invoice_details']['last_payment_date'])->format('Y-m-d H:i');
                $invoice->discount_id=$v['invoice_details']['discount_id'];
                $invoice->discount_amount=$totalDiscount;
                $invoice->subtotal=$subTotalAmount;
                $invoice->total_amount=$totalAmount;
                $invoice->tax=$this->_taxCalculate($subTotalAmount,$businessTpeValue->tax);
                $invoice->tdr_type=$businessTpeValue->tdr_type;
                $invoice->tdr_value=$tdrValue;
                $invoice->my_tdr=$businessTpeValue->my_tdr;
                $invoice->services_tdr=$businessTpeValue->services_tdr;
                $invoice->total_tdr=$businessTpeValue->my_tdr+$businessTpeValue->services_tdr;
                $invoice->payment_status='Unpaid';
                $invoice->save();

                ClientDiscount::where('id',$v['invoice_details']['discount_id'])->where('client_id',auth()->user()->id)->increment('use');
                //invoice details and notification save
                $this->_invoiceDetailsSave($v['invoice_details']['items'],$invoice->id,$v['invoice_details']['client_business_type_id']);
                $this->_notificationSave($invoice);
                $data['customer_info']=array('name'=>$v['customer_info']['name'],'id'=>$invoice->id,'total_amount'=>$totalAmount,'lastDate'=>$invoice->last_payment_date,);

                $mailConfig=config('system_mail');

                if ($mailConfig['all']['status'] && $mailConfig['mail']['invoice']) {
                    Mail::to($v['customer_info']['email'])->send(new InvoiceInfo($data));
                }

           }
//
            DB::commit();
            $request->session()->forget('invoice');
            Session::flash('message', 'Invoice Successfully Save.');
        } catch (\Exception $e) {

            DB::rollback();
            Session::flash('danger',"SomeThing Problems");
        }
        return redirect()->route('invoice.create')->withInput();

    }

    public  function singleInvoicePreview($id){

        $data['single_invoice']=Invoice::with(['relInvoiceDetails','relUser','relBusinessType'])->where('id',$id)->first();

        $data['discount']= ClientDiscount::where('status', '!=', 'Used')->where('id', $data['single_invoice']->discount_id)->where('client_id', Auth::user()->id)->first();
        $data['business_type']= BusinessType::select('name', 'id', 'client_id', 'tax','tdr_type','my_tdr','services_tdr','total_tdr','logo')->where('id',$data['single_invoice']->client_business_type_id)->where('client_id',auth()->user()->id)->first();

         return view('backend.invoice.single_preview',$data);
    }

    // invoice details save

    private  function  _invoiceDetailsSave($invoiceDetailsItems,$ivoiceId,$clientBusinessId){

        foreach ($invoiceDetailsItems as $i=>$detailV){
            $itemName=ItemsModel::where('id',$detailV['item_id'])->first();
            $invoiceDetails=new InvoiceDetails();
            $invoiceDetails->invoice_id=$ivoiceId;
            $invoiceDetails->item_id=$detailV['item_id'];
            $invoiceDetails->client_business_type_id=$clientBusinessId;
            $invoiceDetails->item_name=$itemName->name;
            $invoiceDetails->quantity=$detailV['quantity'];
            $invoiceDetails->unit_price=$detailV['unit_price'];
            $invoiceDetails->total_amount=($detailV['unit_price'] * $detailV['quantity']);
            $invoiceDetails->save();
        }
    }
    //notification details save
    private  function  _notificationSave($invoiceDetails){

        $notifi=new Notifications();
        $notifi->user_id=$invoiceDetails->customer_id;
        $notifi->process_table='invoices';
        $notifi->process_id=$invoiceDetails->id;
        $notifi->method=$invoiceDetails->notification_method;
        $notifi->url_code=base64_encode($invoiceDetails->id);
        $notifi->fire_date=$invoiceDetails->notification_date;
        $notifi->status='Pending';

        if ($invoiceDetails->notification_method=='Email'){
            $templateContent="Dear Customer, Your Total Amount: ....,Last Payment Date:...., Please Pay your total Amount.Click Details";
            $notifi->method=$invoiceDetails->notification_method;
            $notifi->content=$templateContent;
            $notifi->save();
        }if ($invoiceDetails->notification_method=='SMS'){
            $notifi->method=$invoiceDetails->notification_method;
            $templateContent="Dear Customer, Please Pay your total Amount.Click Details";
            $notifi->content=$templateContent;
            $notifi->save();
        }
        if ($invoiceDetails->notification_method=='Both'){

            $notifi=new Notifications();
            $notifi->user_id=$invoiceDetails->customer_id;
            $notifi->process_table='invoices';
            $notifi->process_id=$invoiceDetails->id;
            $notifi->method='Email';
            $notifi->content="Dear Customer, Your Total Amount: ....,Last Payment Date:...., Please Pay your total Amount.Click Details";;
            $notifi->url_code=base64_encode($invoiceDetails->id);
            $notifi->fire_date=$invoiceDetails->notification_date;
            $notifi->status='Pending';
            $notifi->save();

            $notifi=new Notifications();
            $notifi->user_id=$invoiceDetails->customer_id;
            $notifi->process_table='invoices';
            $notifi->process_id=$invoiceDetails->id;
            $notifi->method='SMS';
            $notifi->content="Dear Customer, Please Pay your total Amount.Click Details";;
            $notifi->url_code=base64_encode($invoiceDetails->id);
            $notifi->fire_date=$invoiceDetails->notification_date;
            $notifi->status='Pending';
            $notifi->save();
        }



    }
//total discount amount calculate
    private  function _totalDiscoutAmount($totalAmount,$type,$value){
        if ($type=="Percentage"){
            return $finalAmount=($totalAmount * ($value/100) );
        }
        if ($type=="Fixed"){
            return $finalAmount=$value;
        }
    }

//total Tax calculate amount
    private  function  _taxCalculate($totalAmount,$value){
        return $finalAmount=($totalAmount*($value/100));
    }




}
