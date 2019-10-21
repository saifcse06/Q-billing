<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientBusinessTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_business_types', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('client_id');
            $table->unsignedInteger('store_id')->nullable();
            $table->foreign('client_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->string('name',150);
            $table->string('logo',255);
            $table->string('contact_name',150);
            $table->string('phone_number',20);
            $table->string('email',255)->nullable();
            $table->text('address')->nullable();
            $table->double('tax',8,2)->defalut(0);
            $table->enum('tdr_type',['Fixed','Percentage']);
            $table->double('my_tdr',8,2)->defalut(0);
            $table->double('services_tdr',8,2)->defalut(0);
            $table->double('total_tdr',8,2)->defalut(0);
            $table->enum('status',['Pending','Rejected','Active','Inactive'])->comments('Pending for store creation status in payment gateway');
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
        Schema::dropIfExists('client_business_types');
    }
}
