<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->bigIncrements('id');
            //$table->string('kode',5);
            $table->string('name',33);
            $table->string('file',100)->nullable();
            //$table->integer('quota');
            $table->integer('price');
            //$table->enum('status',['kosong','terpesan']);
            $table->integer('cap')->usigned();
            $table->integer('slot')->unsigned();
            $table->text('desc');
            $table->bigInteger('hotel_id')->unsigned();
            $table->index('hotel_id');
            //$table->foreign('admin_id')->references('id')->on('dests')->onUpdate('cascade')->onDelete('restrict');
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
}
