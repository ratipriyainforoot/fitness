<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('country_id');
            $table->string('state_id');
            $table->string('city_id');
            $table->string('area');
            $table->string('block');
            $table->string('street');
            $table->string('avenue');
            $table->string('house');
            $table->string('floor');
            $table->string('apartment');
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
        Schema::dropIfExists('addresses');
    }
}
