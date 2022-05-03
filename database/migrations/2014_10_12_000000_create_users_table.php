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
            $table->increments('id');
            $table->string('first_name',100);
            $table->string('last_name',100);
            $table->string('email')->unique();
            $table->string('username',100);
            $table->string('password',100);
            $table->string('phone',20);
            $table->string('address_line1',200);
            $table->string('address_line2',200)->nullable();
            $table->string('country',20);
            $table->string('state',20);
            $table->string('city',20);
            $table->string('zipcode',20);
            $table->integer('status')->length(1);
            
            $table->rememberToken();
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
