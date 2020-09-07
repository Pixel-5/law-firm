<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('matrimony_id')
                ->constrained('matrimony')
                ->onDelete('CASCADE');
            $table->string('propertiable_id');
            $table->string('propertiable_type');
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
        Schema::table('matrimony_forms', function (Blueprint $table) {
            //
        });
    }
}
