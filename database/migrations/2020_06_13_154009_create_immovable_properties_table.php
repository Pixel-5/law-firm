<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImmovablePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('immovable_properties', function (Blueprint $table) {
            $table->id();
            $table->string('plot_number')->unique();
            $table->string('type');
            $table->string('development');
            $table->string('value');
            $table->string('fully_paid_for');
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
        Schema::dropIfExists('immovable_properties');
    }
}
