<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplateTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('template_type', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('template_id');
            $table->integer('type_id');
        });
        DB::table('template_type')->insert(
        array(
            'template_id'  => '1',
            'type_id'      => '1',
        )
        );
        DB::table('template_type')->insert(
        array(
            'template_id'  => '3',
            'type_id'      => '2',
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
        Schema::dropIfExists('template_type');
    }
}
