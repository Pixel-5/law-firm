<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConveyancingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conveyancing', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->string('status')->default('pending');
            $table->foreignId('client_id')
            ->constrained('clients');
            $table->foreignId('user_id')
                ->nullable();
            $table->string('other_id');
            $table->string('other_type');
            $table->foreignId('transaction_id')->constrained('plot_transactions');
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
