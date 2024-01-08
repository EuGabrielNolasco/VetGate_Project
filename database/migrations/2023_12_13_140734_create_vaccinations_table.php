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
        // Criação da tabela 'vaccinations'
        Schema::create('vaccinations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('animal_id')->constrained();
            $table->string('health_status')->nullable();
            $table->string('respiratory_rate')->nullable();
            $table->string('heart_rate')->nullable();
            $table->string('contactante')->nullable();
            $table->string('dewormed_status')->nullable();
            $table->string('date_dewormed')->nullable();
            $table->string('vaccinated_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vaccinations');
    }
};
