<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('templates', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title');
            $table->string('slug',255); // slug for sorting
            $table->timestamps();
        });
        DB::table('templates')->insert(
        array(
            'title'    => 'Basic Page',
            'slug'     => 'basic-page',
        )
        );
        DB::table('templates')->insert(
        array(
            'title'    => 'Home Page',
            'slug'     => 'home-page',
        )
        );
        DB::table('templates')->insert(
        array(
            'title'    => 'Blog',
            'slug'     => 'blog',
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
        Schema::dropIfExists('templates');
    }
}
