<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuTemplateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('menu_template', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('template_id');
            $table->integer('menu_id');
        });
        DB::table('menu_template')->insert(
        array(
            'id'           => 1,
            'menu_id'      => 1,
            'template_id'  => 1,
        )
        );
        DB::table('menu_template')->insert(
        array(
            'id'           => 2,
            'menu_id'      => 1,
            'template_id'  => 2,
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
        Schema::dropIfExists('menu_template');
    }
}
