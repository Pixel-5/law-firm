<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSchedulesTable extends Migration
{
    public function up()
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->unsignedInteger('schedule_id')->nullable();
            $table->foreign('schedule_id', 'schedule_fk_556522')->references('id')->on('schedules');
        });
    }
}
