<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('forms', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title');
            $table->string('slug',255); // slug for sorting
            $table->string('cta',255)->nullable(); // cta for submit buttons
            $table->string('redirect',255)->nullable(); // cta for submit buttons
            $table->longText('notifications')->nullable(); // cta for submit buttons
            $table->timestamps();
            $table->softDeletes();
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('forms');
    }
}
