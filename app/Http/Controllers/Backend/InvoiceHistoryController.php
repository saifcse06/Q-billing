<?php

namespace App\Http\Controllers\Backend;

use App\BusinessType;
use App\ClientDiscount;
use App\Invoice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InvoiceHistoryController extends Controller
{
    //
    protected $allInvoiceLists;

    public function __construct(Invoice $allInvoiceLists)
    {
        $this->allInvoiceLists = $allInvoiceLists;
    }

    public function listOfInvoiceHistory(Request $request){

        $data['title']="Invoice Lists";

        $all=$this->allInvoiceLists;

        if($request->has('payment_status') && $request->payment_status != null)
        {
            $all=$all->where('payment_status','=',$request->payment_status);
        }

        $data['allInvoiceLists']=$all->where('customer_id',auth()->user()->id)->with(['relUser','relBusinessType'])->paginate(config('system.pagination.items_per_page'));
        $data['serial']=managePagination($data['allInvoiceLists']);

        if ($request->ajax()) {
            return view('backend.customer_invoice.table_load',$data)->render();
        }
        return view('backend.customer_invoice.list_history',$data);
    }

    public function customerDetailsInvoice($id){
        $data['single_invoice']=Invoice::with(['relInvoiceDetails','relUser','relBusinessType'])->where('id',$id)->first();
        $data['discount']= ClientDiscount::where('status', '!=', 'Used')->where('id', $data['single_invoice']->discount_id)->where('client_id',$data['single_invoice']->client_id)->first();
        $data['business_type']= BusinessType::select('name', 'id', 'client_id', 'tax','tdr_type','my_tdr','services_tdr','total_tdr')->where('id',$data['single_invoice']->client_business_type_id)->where('client_id',$data['single_invoice']->client_id)->first();

        return view('backend.customer_invoice.invoice_details',$data);
    }
}
