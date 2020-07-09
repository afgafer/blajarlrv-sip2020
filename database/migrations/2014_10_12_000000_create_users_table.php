<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->string('name',33);
            //$table->string('file',100)->nullable();
            $table->string('email',100)->unique();
            $table->char('contact',12)->nullable();
            //$table->timestamp('email_verified_at')->nullable();
            $table->string('password',60);
            //$table->rememberToken();
            $table->enum('type',[0,1])->nullable();
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
        Schema::dropIfExists('users');
    }
}
