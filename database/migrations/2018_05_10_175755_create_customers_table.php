<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
	        $table->increments('id');
	        $table->string('firstname', 50);
	        $table->string('lastname', 50);
	        $table->string('email', 128)->unique();
	        $table->string('street', 128);
	        $table->string('housenum', 5);
	        $table->string('postcode', 10);
	        $table->string('city', 50);
	        $table->string('birthday', 28);
	        $table->string('password', 255);
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
        Schema::dropIfExists('customers');
    }
}
