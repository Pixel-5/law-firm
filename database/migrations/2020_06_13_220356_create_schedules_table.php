<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('schedule_appointment')->default('client');
            $table->foreignId('attorney_id')
                ->constrained('users')
                ->onDelete('CASCADE');
            $table->integer('scheduleable_id');
            $table->string('scheduleable_type');
            $table->text('notes')->nullable();
            $table->string('venue');
            $table->datetime('start_time');
            $table->datetime('end_time');
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
        Schema::dropIfExists('schedules');
    }
}
