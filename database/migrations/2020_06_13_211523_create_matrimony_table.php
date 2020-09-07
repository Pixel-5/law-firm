<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatrimonyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matrimony', function (Blueprint $table) {
            $table->id();
            $table->foreignId('litigation_id')
                ->constrained('litigation')
                ->onDelete('cascade');
            $table->string('omang_name');
            $table->string('marriage_name');
            $table->string('maiden_name')->nullable();

            $table->boolean('is_citizen');
            $table->boolean('is_resident');
            $table->date('resident_since')->nullable();
            $table->date('date_marriage');
            $table->string('place_of_marriage');
            $table->string('regime');
            $table->string('marriage_certificate_copy')->nullable();

            $table->boolean('has_lived_together');
            $table->date('lived_together_from')->nullable();
            $table->date('lived_together_to')->nullable();

            $table->boolean('has_lived_part');
            $table->date('lived_apart_from')->nullable();
            $table->date('lived_apart_to')->nullable();

            $table->boolean('has_sued_divorce');
            $table->date('date_sued_divorce')->nullable();
            $table->string('case_number')->nullable();
            $table->string('attach_court_copies')->nullable();

            $table->boolean('has_written_agreement');
            $table->string('written_agreement_copies')->nullable();
            $table->boolean('has_grant_custody')->default(false);
            $table->text('grant_custody_reasons')->nullable();


            $table->text('divorce_reasons');
            $table->text('divorce_cause');

            $table->boolean('has_sort_help')->default(false);
            $table->boolean('still_living_with_spouse')->default(false);
            $table->date('date_stopped_living_together')->nullable();
            $table->string('matrimonial_house_keeper');
            $table->text('reason_leaving')->nullable();

            $table->string('liabilities')->nullable();
            $table->string('property_division');

            $table->string('marital_children')->nullable();
            $table->string('major_children')->nullable();

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
        Schema::table('Matrimony', function (Blueprint $table) {
            //
        });
    }
}
