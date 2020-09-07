<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancialNeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financial_needs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('matrimony_id')
                ->constrained('matrimony')
                ->onDelete('CASCADE');
            $table->string('school_expenses');
            $table->string('transportation');
            $table->string('clothes');
            $table->string('groceries');
            $table->string('house_keeper');
            $table->string('shelter');
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
        Schema::dropIfExists('financial_needs');
    }
}
