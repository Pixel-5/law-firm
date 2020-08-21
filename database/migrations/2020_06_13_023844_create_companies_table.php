<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->string('name')->unique();
            $table->string('doi')->nullable();
            $table->string('slug');
            $table->string('entity')->nullable();
            $table->string('physical_address');
            $table->string('postal_address');
            $table->string('director_name')->nullable();
            $table->string('director_physical_address')->nullable();
            $table->string('director_postal_address')->nullable();
            $table->string('shareholders')->nullable();
            $table->string('tel')->nullable();
            $table->string('cell');
            $table->string('fax')->nullable();
            $table->string('email');
            $table->string('preferred_email')->nullable();
            $table->string('preferred_contact')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('directors_postal_address')->nullable();
            $table->string('directors_physical_address')->nullable();
            $table->string('alternative_contact')->nullable();
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
        Schema::dropIfExists('company_files');
    }
}
