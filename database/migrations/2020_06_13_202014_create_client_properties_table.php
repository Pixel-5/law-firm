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
            $table->foreignId('client_id')
                ->constrained('files', 'id');
            $table->foreignId('immovable_id')
                ->constrained('immovable_properties', 'id');
            $table->foreignId('movable_id')
                ->constrained('movable_properties', 'id');
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
