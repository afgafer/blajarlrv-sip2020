<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',33);
            $table->string('file',100)->nullable();
            //$table->string('email',100)->unique();
            $table->bigInteger('dest_id')->unsigned();
            $table->index('dest_id');
            $table->bigInteger('hotel_id')->unsigned()->nullable();
            $table->index('hotel_id');
            $table->bigInteger('user_id')->unsigned()->unique();
            $table->index('user_id');
            // $table->timestamps();;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
