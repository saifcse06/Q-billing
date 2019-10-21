<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('client_id');
            $table->foreign('client_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->unsignedInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->unsignedInteger('customer_group_id')->default(0)->nullable();
            $table->foreign('customer_group_id')->references('id')->on('customer_groups')->onDelete('restrict')->onUpdate('cascade');
            $table->unsignedInteger('client_business_type_id');
            $table->foreign('client_business_type_id')->references('id')->on('client_business_types')->onDelete('restrict')->onUpdate('cascade');
            $table->string('bundle_id',64)->nullable();
            $table->string('invoice_no');
            $table->date('notification_date')->nullable();
            $table->enum('notification_method',['Email','SMS','Both'])->nullable();
            $table->date('publish_date')->nullable();
            $table->date('last_payment_date')->nullable();
            $table->double('subtotal',8,2);
            $table->unsignedInteger('discount_id')->nullable();
            $table->foreign('discount_id')->references('id')->on('discounts')->onDelete('restrict')->onUpdate('cascade');
            $table->double('discount_amount',8,2)->default(0);
            $table->double('tax',8,2)->default(0);
            $table->enum('tdr_type',['Fixed','Percentage']);
            $table->double('tdr_value',8,2)->default(0);
            $table->double('my_tdr',8,2)->default(0);
            $table->double('total_amount',8,2)->default(0);
            $table->double('services_tdr',8 ,2)->default(0);
            $table->double('total_tdr',8 ,2)->default(0);
            $table->text('note')->nullable();
            $table->enum('payment_status',['Paid','Unpaid']);
            $table->enum('status',['create','Cancel','Rejected','Expired']);
            $table->unsignedInteger('created_by')->default(0);
            $table->unsignedInteger('updated_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
