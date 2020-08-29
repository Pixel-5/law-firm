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
            $table->string('category');
            $table->foreignId('initial_consultation_id')
                ->nullable();
            $table->foreignId('user_id')
                ->nullable();
            $table->foreignId('client_id')
                ->constrained('clients')
                ->onDelete('CASCADE');
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
