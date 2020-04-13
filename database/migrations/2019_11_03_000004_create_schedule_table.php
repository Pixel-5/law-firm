<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleTable extends Migration
{
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->increments('id');

            $table->string('user_id');

            $table->string('case_id');

            $table->text('notes');

            $table->string('venue');

            $table->datetime('start_time');

            $table->datetime('end_time');

            $table->string('recurrence');

            $table->timestamps();

            $table->softDeletes();
        });
    }
}