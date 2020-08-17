<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlotTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plot_transfers', function (Blueprint $table) {
            $table->id();
            $table->string('client_type');
            $table->string('other_type');
            $table->foreignId('other_individual_id')
                ->constrained('individuals','id');
            $table->foreignId('other_companies_id')
                ->constrained('companies','id');
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
        Schema::dropIfExists('plot_transfers');
    }
}
