<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConveyancingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conveyancings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('file_id')
                ->constrained('files', 'id')
                ->onDelete('cascade');
            $table->foreignId('conveyancing_form_id')
                ->constrained('conveyancing_forms','id')
                ->onDelete('CASCADE');
            $table->string('number');
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
        Schema::dropIfExists('conveyancings');
    }
}
