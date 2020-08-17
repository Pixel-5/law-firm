<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRetainersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retainers', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->string('slug');
            $table->foreignId('individuals_id')
                ->constrained()
                ->onDelete('CASCADE');
            $table->foreignId('companies_id')
                ->constrained()
                ->onDelete('CASCADE');
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
        Schema::dropIfExists('retainer_files');
    }
}
