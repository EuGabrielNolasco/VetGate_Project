<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        // Criação da tabela 'animals'
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('owner_name')->nullable();
            $table->string('address')->nullable();
            $table->string('neighborhood')->nullable();
            $table->string('contact')->nullable();
            $table->string('race')->nullable();
            $table->string('species')->nullable();
            $table->date('birth')->nullable();
            $table->string('exercise_routine')->nullable();
            $table->string('reproductive_status')->nullable();
            $table->string('size')->nullable();
            $table->string('fur_length')->nullable();
            $table->string('origin')->nullable();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->boolean('deleted')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};
