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
            $table->string('number');
            $table->string('matter');
            $table->text('description');
            $table->foreignId('litigation_id')
                ->constrained('litigation')
                ->onDelete('CASCADE');
            $table->time('start_time');
            $table->time('end_time');
            $table->date('date');
            $table->string('venue');
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
