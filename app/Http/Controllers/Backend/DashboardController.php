<?php

namespace App\Http\Controllers\Backend;

use App\BusinessType;
use App\Invoice;
use App\TransactionsModel;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rules\In;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->type=='Client'){
            $data['total_employee']=User::where('parent_id',auth()->user()->id)->where('type','Employee')->where('status','Active')->count();
            $data['total_client_business']=BusinessType::where('client_id',auth()->user()->id)->where('status','Active')->count();
            $data['total_invoice_create']=Invoice::where('client_id',auth()->user()->id)->where('status','create')->count();
            $data['uppaidInvoice']=Invoice::where('client_id',auth()->user()->id)->where('payment_status','Unpaid')->count();
            $data['paidAmount']=Invoice::where('client_id',auth()->user()->id)->where('payment_status','Paid')->sum('total_amount');
            return view('backend/dashboard_client',$data);
        }
        if (auth()->user()->type=='Customer'){


             $data['total_paid']=Invoice::where('customer_id',auth()->user()->id)->where('payment_status','Paid')->count();
            $data['total_unpaid']=Invoice::where('customer_id',auth()->user()->id)->where('payment_status','Unpaid')->count();

            $data['total_paidAmount']=Invoice::where('customer_id',auth()->user()->id)->where('payment_status','Paid')->sum('total_amount');
            $data['total_unpaidAmount']=Invoice::where('customer_id',auth()->user()->id)->where('payment_status','Unpaid')->sum('total_amount');

            return view('backend/dashboard_customer',$data);
        }
        if (auth()->user()->type=='Admin'){
            $data['total_admin']=User::where('type','Admin')->where('status','Active')->count();
            $data['total_client']=User::where('type','Client')->where('status','Active')->count();
            $data['total_customer']=User::where('type','Customer')->where('status','Active')->count();

            $data['total_transaction']=TransactionsModel::where('status','VALID')->sum('payment_amount');
            $data['failed_transaction']=TransactionsModel::where('status','Failed')->count();
            $data['uppaidInvoice']=Invoice::where('payment_status','Unpaid')->count();
            $data['paidInvoice']=Invoice::where('payment_status','Paid')->count();

            return view('backend/dashboard_admin',$data);
        }
        return redirect('login');
    }
}
