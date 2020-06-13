<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConveyancingFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conveyancing_forms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('transaction_type');
            $table->string('plot_no')->unique();
            $table->string('situated_at');
            $table->string('title_deed');
            $table->boolean('property_bounded')->default(false);
            $table->double('purchase_price');
            $table->double('initial_payment');
            $table->text('notes');
            $table->foreignId('plot_transfer_id')
                ->constrained('plot_transfers','id');
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
        Schema::dropIfExists('conveyancing_information_forms');
    }
}
