<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('contents', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title');
            $table->string('slug',255); // slug for sorting
            $table->text('featimg')->nullable(); // featured image
            $table->text('metadesc')->nullable(); // placed in the header
            $table->string('keywords',255)->nullable(); // placed in the header
            $table->integer('template_id')->nullable(); // template type override
            $table->integer('type_id'); // post, page, etc
            $table->integer('published')->default(0); // 0 is draft 1 is published
            $table->timestamps();
            $table->softDeletes();
        });
        DB::table('contents')->insert(
        array(
            'title'         => 'Home',
            'slug'          => 'home',
            'type_id'       => '1',
            'template_id'   => '2',
            'published'     => '1',
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
        Schema::dropIfExists('contents');
    }
}
