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
            $table->string('slug');
            $table->string('dob');
            $table->string('identifier');
            $table->string('gender');
            $table->string('physical_address');
            $table->string('tel')->nullable();
            $table->string('cell');
            $table->string('fax')->nullable();
            $table->string('email');
            $table->string('preferred_email');
            $table->string('preferred_contact');
            $table->string('marital_status');
            $table->string('name_spouse');
            $table->string('name_next_kin');
            $table->string('contact_next_kin');
            $table->string('preferred_invoice');
            $table->string('docs');
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
