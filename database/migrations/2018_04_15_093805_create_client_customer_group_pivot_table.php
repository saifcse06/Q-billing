<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientCustomerGroupPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_customer_group_pivot', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('client_id');
            $table->foreign('client_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->unsignedInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->unsignedInteger('group_id')->default(0);
            $table->foreign('group_id')->references('id')->on('customer_groups')->onDelete('restrict')->onUpdate('cascade');
            $table->enum('status',['Active','Inactive']);
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
        Schema::dropIfExists('client_customer_group_pivot');
    }
}
