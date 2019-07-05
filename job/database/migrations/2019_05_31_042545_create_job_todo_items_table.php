<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobTodoItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_todo_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('job_number_fk');
            $table->integer('note_id');
            $table->text('action');
            $table->boolean('is_complete')->default('0');
            $table->dateTime('created');
            $table->dateTime('modified')->nullable();
            $table->dateTime('completed_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_todo_items');
    }
}
