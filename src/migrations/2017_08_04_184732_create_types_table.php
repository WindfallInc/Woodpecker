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
            $table->string('slug'); // slug for sorting
            $table->string('icon',255); // set icon?
            $table->integer('categories')->nullable(); // Allow Categories?
            $table->integer('editor')->nullable(); // Allow editor?
            $table->integer('time')->nullable(); // Time sensitive content? (events, announcements, news, classes, exhibits)
            $table->timestamps();
            $table->softDeletes();
        });
        DB::table('types')->insert(
        array(
            'title'        => 'Page',
            'slug'         => 'page',
            'editor'       => '1',
            'categories'   => '1',
            'icon'         => 'fa-files-o',
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
