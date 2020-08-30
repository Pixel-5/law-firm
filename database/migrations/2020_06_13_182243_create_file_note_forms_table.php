<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileNoteFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('file_note_forms', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->foreignId('litigation_id')
                ->constrained('litigation')
                ->onDelete('cascade');
            $table->string('other_party');
            $table->string('judge_name');
            $table->string('other_attorneys');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('venue');
            $table->text('description');
            $table->time('time_taken');
            $table->double('hourly_rate');
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
        Schema::dropIfExists('file_note_forms');
    }
}
