<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Mail\PaymentComplete;
use App\TransactionsModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Libraries\SSLCommerz;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Session;

class PaymentController extends Controller
{
    //
    public function getPaymentOption(Request $request,$status){
        DB::beginTransaction();
        try {

            $invoicInfo=Invoice::where('id',$request->value_a)->with('relUser')->first();

        $payHistory=new TransactionsModel();
        $payHistory->tran_id=$request->tran_id;
        $payHistory->store_id=$request->store_id;
        $payHistory->client_id=$invoicInfo->client_id;
        $payHistory->customer_id=$invoicInfo->customer_id;
        $payHistory->invoice_id=$invoicInfo->id;
        $payHistory->client_id=$invoicInfo->client_id;
        $payHistory->payment_amount=$request->amount;
        $payHistory->status=$request->status;
        $payHistory->payment_date=date('Y-m-d');
        $payHistory->gateway_data=serialize($request->all());
        $payHistory->save();



        if ($status=='success'){
            $invoic=Invoice::findOrFail($invoicInfo->id);
            $invoic->payment_status='Paid';
            $invoic->save();
            $data['payment_info']=$invoicInfo;
            $data['payment_data']=$payHistory->payment_date;
            $data['payment_status']=$request->status;

            $mailConfig=config('system_mail');
            if ($mailConfig['all']['status'] && $mailConfig['mail']['payment_complete']) {
                Mail::to($request->value_b)->send(new PaymentComplete($data));
            }
            Session::flash('message', 'Payment Complete Successfully.');

        }
        if ($status=='cancel'){
            $invoic->payment_status='Unpaid';

            Session::flash('danger', 'Payment Failed Successfully.');

        }if ($status=='failed'){
            $invoic->payment_status='Unpaid';

            Session::flash('warning', 'Payment Cancel Successfully.');

        }

            $invoic->save();
            DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {

            DB::rollback();
            Session::flash('warning',"SomeThing Problems");
        }

        return redirect()->back();
    }


    public  function getTransactionList(Request $request){
        if (auth()->user()->type=='Admin'){
            $data['all_history']=TransactionsModel::with('relUser')->orderBy('id','desc')->paginate(config('system.pagination.items_per_page'));
        }
        if (auth()->user()->type=='Client'){
            $data['all_history']=TransactionsModel::with('relUser')->where('client_id',auth()->user()->id)->orderBy('id','desc')->paginate(config('system.pagination.items_per_page'));
        }
        if (auth()->user()->type=='Customer'){
            $data['all_history']=TransactionsModel::with('relUser')->where('customer_id',auth()->user()->id)->orderBy('id','desc')->paginate(config('system.pagination.items_per_page'));
        }
        $data['serial']=managePagination($data['all_history']);
        if ($request->ajax()) {
            return view('backend.transaction.table_load',$data)->render();
        }
        return view('backend.transaction.transaction_history',$data);
    }

}
