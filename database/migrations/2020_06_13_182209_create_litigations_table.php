<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLitigationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('litigations', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->foreignId('initial_consultation_id')
                ->constrained('initial_consultation_forms', 'id')
                ->onDelete('cascade');
            $table->foreignId('file_id')
                ->constrained('files', 'id')
                ->onDelete('CASCADE');
            $table->foreignId('client_type')
                ->constrained('client_types','id');
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
        Schema::dropIfExists('litigations');
    }
}
