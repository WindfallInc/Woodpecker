<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title');
            $table->string('slug',255); // slug for sorting
            $table->timestamps();
            $table->softDeletes();
        });
        DB::table('menus')->insert(
        array(
            'title'    => 'Top Nav',
            'slug'     => 'top-nav',
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
        Schema::dropIfExists('menus');
    }
}
