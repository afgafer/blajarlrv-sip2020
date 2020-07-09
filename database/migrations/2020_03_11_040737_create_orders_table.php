<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('invoice',12);
            //$table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('member_id');
            $table->index('member_id');
            $table->unsignedBigInteger('hotel_id');
            $table->index('hotel_id');
            $table->string('name',33);
            $table->char('contact',12);
            $table->date('cin');
            $table->date('cout');
            //$table->integer('duration');
            $table->integer('count');
            $table->integer('bill');
            $table->enum('status',[0,1,2,3,4]);
            $table->string('file')->nullable();
            //$table->foreign('id_kamar')->references('id')->on('kamar')->onUpdate('cascade')->onDelete('restrict');
            //$table->foreign('id_anggota')->references('id')->on('anggota')->onUpdate('cascade')->onDelete('restrict');
            $table->timestamps();
            //select id FROM kamar WHERE id NOT IN(SELECT id_kamar FROM pesan where masuk BETWEEN '2020-12-31' and '2020-12-31' OR '2020-12-31' BETWEEN masuk and keluar)
            //SELECT * FROM `pesan` WHERE masuk  SELECT * FROM kamar WHERE id NOT IN(SELECT id_kamar FROM pesan where masuk NOT BETWEEN '2020-12-24' and '2020-12-26' and '2020-12-24'  NOT BETWEEN masuk and keluar)
            // SELECT id FROM pesan where masuk BETWEEN '2020-12-26' and '2020-12-31' OR '2020-12-26' BETWEEN masuk and keluar
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
