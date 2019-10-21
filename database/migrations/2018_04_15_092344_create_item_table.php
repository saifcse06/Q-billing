<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('business_type_id');
            $table->foreign('business_type_id')->references('id')->on('client_business_types')->onDelete('restrict')->onUpdate('cascade');
            $table->unsignedInteger('client_id');
            $table->foreign('client_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->string('name',150);
            $table->double('price',8,2);
            $table->longText('details')->nullable();
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
        Schema::dropIfExists('items');
    }
}
