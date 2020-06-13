<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_files', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->string('name')->unique();
            $table->string('slug');
            $table->string('entity');
            $table->string('physical_address');
            $table->string('postal_address');
            $table->string('director_name');
            $table->string('director_physical_address');
            $table->string('director_postal_address');
            $table->string('tel')->nullable();
            $table->string('cell');
            $table->string('fax')->nullable();
            $table->string('email');
            $table->string('preferred_email');
            $table->string('preferred_contact');
            $table->string('contact_person');
            $table->string('directors_postal_address');
            $table->string('directors_physical_address');
            $table->string('alternative_contact')->nullable();
            $table->string('preferred_invoice');
            $table->string('docs');
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
        Schema::dropIfExists('company_files');
    }
}
