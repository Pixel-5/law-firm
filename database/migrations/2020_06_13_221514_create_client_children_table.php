<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientChildrenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_children', function (Blueprint $table) {
            $table->id();
            $table->foreignId('matrimony_id')
                ->constrained('matrimony')
                ->onDelete('CASCADE');
            $table->string('name');
            $table->string('dob');
            $table->string('school');
            $table->string('standard');
            $table->string('residence_place');
            $table->string('marital')->nullable();
            $table->string('non_marital')->nullable();
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
        Schema::dropIfExists('client_childrens');
    }
}
