<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('answers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('submission_id')->nullable(); // the submission that this answer belong to
            $table->integer('question_id')->nullable(); // the question that this answer belong to
            $table->string('content')->nullable(); // content of the answer
            $table->timestamps();
            $table->softDeletes();
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('submissions');
    }
}
