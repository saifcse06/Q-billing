<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type',['Admin','Client','Customer','Employee']);
            $table->unsignedInteger('parent_id')->nullable();
            $table->string('name');
            $table->text('address')->nullable();
            $table->string('phone',20)->unique();
            $table->string('email')->unique()->nullable();
            $table->string('password');
            $table->string('profile_picture')->nullable();
            $table->string('nid',20)->nullable();
            $table->string('passport',30)->nullable();
            $table->string('birth_certificate',25)->nullable();
            $table->enum('status', ['Pending','Active', 'Inactive','Suspended']);
            $table->rememberToken();
            $table->unsignedInteger('created_by')->default(0);
            $table->unsignedInteger('updated_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
        Artisan::call('db:seed', [
            '--class' => UserTableSeeder::class,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
