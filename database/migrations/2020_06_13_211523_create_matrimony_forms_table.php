<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatrimonyFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matrimony_forms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('litigation_id')
                ->constrained('litigation')
                ->onDelete('cascade');
            $table->foreignId('spouse_id')
                ->constrained('individuals','id');
            $table->string('regime');
            $table->date('resident_when');
            $table->date('spouse_resident_when');
            $table->date('marriage_reside_from');
            $table->date('marriage_reside_to');
            $table->date('lived_together_to');
            $table->date('lived_together_from');
            $table->date('lived_apart_from');
            $table->date('lived_apart_to');
            $table->foreignId('children_id')
                ->constrained('client_children','id');
            $table->boolean('grant_custody')->default(false);
            $table->text('grant_custody_reasons');
            $table->boolean('marital_children')->default(false);
            $table->boolean('major_children')->default(false);
            $table->boolean('sued_divorce')->default(false);
            $table->date('sued_divorce_date');
            $table->boolean('written_agreement')->default(false);
            $table->string('copy_written_agreement')->nullable();
            $table->text('divorce_reasons');
            $table->text('divorce_cause');
            $table->boolean('sort_help')->default(false);
            $table->boolean('living_together')->default(false);
            $table->date('date_stopped_living_together');
            $table->string('matrimonial_home')->nullable();
            $table->text('reason_leaving');
            $table->foreignId('property_id')
                ->constrained('client_properties','id');
            $table->foreignId('financial_id')
                ->constrained('financial_needs','id');
            $table->text('liabilities');
            $table->text('division_proposal');
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
        Schema::table('MatrimonyForm', function (Blueprint $table) {
            //
        });
    }
}
