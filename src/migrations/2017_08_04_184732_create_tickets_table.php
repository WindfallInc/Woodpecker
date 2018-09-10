<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable(); // name of ticket person
            $table->string('return_email')->nullable(); // return email
            $table->longText('problem')->nullable(); // description of the problem
            $table->longText('details')->nullable(); // Probelm details for recreating
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
        Schema::dropIfExists('tickets');
    }
}
