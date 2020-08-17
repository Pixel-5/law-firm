<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientSpousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_spouses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')
                ->constrained('individuals','id')
                ->onDelete('CASCADE');
            $table->string('name');
            $table->string('physical_address');
            $table->string('postal_address');
            $table->date('marriage_date');
            $table->date('marriage_place');
            $table->string('nationality');
            $table->boolean('is_citizen')->default(true);
            $table->string('occupation');
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
        Schema::dropIfExists('client_spouses');
    }
}
