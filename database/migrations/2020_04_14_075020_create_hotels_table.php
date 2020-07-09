<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',33);
            $table->string('file',100)->nullable();
            $table->string('contact',12);
            $table->text('address');
            $table->float('lat',10,6)->nullable();
            $table->float('lng',10,6)->nullable();
            $table->text('desc')->nullable();
            $table->unsignedBigInteger('dest_id');
            $table->index('dest_id');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hotels');
    }
}
