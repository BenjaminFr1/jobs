<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('job_number');
            $table->string('client_name');
            $table->string('job_name');
            $table->string('state');
            $table->dateTime('start_date');
            $table->dateTime('due_date');
            $table->string('manager_name')->nullable();
            $table->string('developer_name')->nullable();
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
        Schema::dropIfExists('jobs');
    }
}
