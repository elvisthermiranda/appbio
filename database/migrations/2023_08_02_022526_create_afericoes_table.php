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
        Schema::create('afericoes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('responsavel_id');
            $table->float('peso');
            $table->float('circunferencia_abdominal');
            $table->float('percentual_massa_muscular');
            $table->float('gordura_visceral');
            $table->float('percentual_gordura');
            $table->integer('metabolismo')->nullable();
            $table->integer('idade_metabolica')->nullable();
            $table->float('altura');
            $table->integer('idade');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('responsavel_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('afericoes');
    }
};
