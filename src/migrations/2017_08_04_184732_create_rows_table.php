<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('rows', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('content')->nullable(); //content in rows - the columns will be entered as html tags during the saving process
            $table->integer('content_id')->nullable(); // every content has many rows - rows have html
            $table->integer('order')->nullable(); // control the order in which rows are loaded ->  content->rows->orderBy('order')->get();
            $table->integer('columns')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        DB::table('rows')->insert(
        array(
            'content'    => '<div class="twelve columns"><p>This is your first bit of content. I bet you cannot wait to expand!</p></div>',
            'content_id' => '1',
            'order'      => '1',
            'columns'    => '1',
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
        Schema::dropIfExists('rows');
    }
}
