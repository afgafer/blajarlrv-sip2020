<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',33);
            $table->string('file',100)->nullable();
            $table->char('contact',12);
            $table->text('address');
            $table->float('lat',10,6)->nullable();
            $table->float('lng',10,6)->nullable();
            $table->text('desc')->nullable();
            //$table->bigInteger('id_user')->unsigned()->unique();
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
        Schema::dropIfExists('dests');
    }
}
