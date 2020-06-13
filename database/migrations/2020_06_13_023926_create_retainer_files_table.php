<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRetainerFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retainer_files', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->string('slug');
            $table->foreignId('individual_files_id')
                ->constrained()
                ->onDelete('CASCADE');
            $table->foreignId('company_files_id')
                ->constrained()
                ->onDelete('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('retainer_files');
    }
}
