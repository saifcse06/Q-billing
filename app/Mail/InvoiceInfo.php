<?php

namespace App\Mail;

use App\BusinessType;
use App\ClientDiscount;
use App\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;


class InvoiceInfo extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $data;
    public function __construct($data)
    {
        $this->data=$data;
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       $id=$this->data['customer_info']['id'];
     //   dd($this->data);
        $data['single_invoice']=Invoice::with(['relInvoiceDetails','relUser','relBusinessType'])->where('id',$id)->first();
        $data['discount']= ClientDiscount::where('status', '!=', 'Used')->where('id', $data['single_invoice']->discount_id)->where('client_id', Auth::user()->id)->first();
        $data['business_type']= BusinessType::select('name', 'id', 'client_id', 'tax','tdr_type','my_tdr','services_tdr','total_tdr')->where('id',$data['single_invoice']->client_business_type_id)->where('client_id', Auth::user()->id)->first();
        $this->data=$data;
        return $this->markdown('emails.invoice.invoice_details',$this->data);
    }
}
