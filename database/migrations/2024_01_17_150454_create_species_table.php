<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Database\Seeders\SpeciesTableSeeder; // Adicione esta linha

class CreateSpeciesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (!Schema::hasTable('species')) {
            Schema::create('species', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->timestamps();
            });

            // Chama a Seed SpeciesTableSeeder
            $seeder = new SpeciesTableSeeder();
            $seeder->run();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('species');
    }
}
