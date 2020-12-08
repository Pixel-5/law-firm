<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlotTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plot_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_type');
            $table->string('client_transaction_type');
            $table->string('other_transaction_type');
            $table->foreignId('conveyancing_id')->constrained('conveyancing');
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
        Schema::dropIfExists('plot_transcations');
    }
}
