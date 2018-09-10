<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomFieldTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('custom_field_type', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('custom_field_id');
            $table->integer('type_id');
        });
        DB::table('custom_field_type')->insert(
        array(
            'id'                 => 1,
            'custom_field_id'    => 1,
            'type_id'            => 1
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
        Schema::dropIfExists('custom_field_type');
    }
}
