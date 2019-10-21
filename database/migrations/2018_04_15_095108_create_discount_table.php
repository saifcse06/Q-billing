<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('client_id');
            $table->foreign('client_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->unsignedInteger('client_business_type_id');
            $table->foreign('client_business_type_id')->references('id')->on('client_business_types')->onDelete('restrict')->onUpdate('cascade');
            $table->string('title',255);
            $table->date('expire_date');
            $table->enum('type',['Fixed','Percentage']);
            $table->double('value',8,2);
            $table->unsignedInteger('use')->default(0)->comments('validate the validity');
            $table->enum('status',['Unused','Using','Used']);
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
        Schema::dropIfExists('discounts');
    }
}
