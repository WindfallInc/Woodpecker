<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomFieldTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('custom_fields', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name')->nullable(); // Page, Post, Event, Etc
            $table->string('input',255)->nullable(); // slug for sorting
            $table->timestamps();
        });
        DB::table('custom_fields')->insert(
        array(
            'id'       => 1,
            'name'     => 'Introduction Text',
            'input'    => 'textbox'
        )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('custom_fields');
    }
}
