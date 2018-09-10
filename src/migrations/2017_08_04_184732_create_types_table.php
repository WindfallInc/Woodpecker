<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('types', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title'); // Page, Post, Event, Etc
            $table->string('slug',255); // slug for sorting
            $table->string('categories',255)->nullable(); // Allow Categories?
            $table->timestamps();
            $table->softDeletes();
        });
        DB::table('types')->insert(
        array(
            'title'    => 'Page',
            'slug'     => 'page',
        )
        );
        /*
        DB::table('types')->insert(
        array(
            'title'    => 'Blog',
            'slug'     => 'blog',
        )
      ); */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('types');
    }
}
