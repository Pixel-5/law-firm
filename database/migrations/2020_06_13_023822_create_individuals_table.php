<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndividualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('individuals', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->string('surname');
            $table->string('name');
            $table->string('slug')->nullable();;
            $table->string('dob');
            $table->string('identifier');
            $table->string('gender')->nullable();
            $table->string('nationality')->nullable();
            $table->string('occupation')->nullable();
            $table->boolean('is_citizen')->default(false);
            $table->string('physical_address');
            $table->string('postal_address');
            $table->string('tel')->nullable();
            $table->string('cell');
            $table->string('fax')->nullable();
            $table->string('email');
            $table->string('preferred_email')->nullable();
            $table->string('preferred_contact')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('name_spouse')->nullable();
            $table->string('name_next_kin')->nullable();
            $table->string('contact_next_kin')->nullable();
            $table->string('preferred_invoice')->nullable();
            $table->string('docs')->nullable();
            $table->boolean('agreement_service')->default(false);
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
        Schema::dropIfExists('individual_files');
    }
}
