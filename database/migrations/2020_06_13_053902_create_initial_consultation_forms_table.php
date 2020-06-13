<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInitialConsultationFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('initial_consultation_forms', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('');
            $table->string('other_party');
            $table->foreignId('attorney_id')
                ->constrained('users', 'id');
            $table->datetime('start_time');
            $table->datetime('end_time');
            $table->foreignId('venue_id')
                ->constrained();
            $table->text('description');
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
        Schema::dropIfExists('initial_consultation_forms');
    }
}
