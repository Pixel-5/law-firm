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
            $table->string('name');
            $table->foreignId('litigation_id')
                ->constrained()
                ->onDelete('cascade');
            $table->string('matter');
            $table->string('other_party');
            $table->string('other_attorneys');
            $table->foreignId('attorney')
                ->constrained('users', 'id');
            $table->datetime('start_time');
            $table->datetime('end_time');
            $table->string('venue');
            $table->text('description');
            $table->string('time_taken');
            $table->string('hourly_rate');
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
