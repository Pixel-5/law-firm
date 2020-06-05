<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string("number")->unique();
            $table->string("name");
            $table->string('slug');
            $table->string("surname");
            $table->string("email")->unique();
            $table->string("contact")->unique();
            $table->date("dob");
            $table->string("gender");
            $table->string("postal_address");
            $table->string("physical_address");
            $table->string("docs")->nullable(true);
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
        Schema::dropIfExists('files');
    }
}
