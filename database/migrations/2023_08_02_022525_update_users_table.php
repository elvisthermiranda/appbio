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
        Schema::table('users', function (Blueprint $table) {
            $table->string('cpf', 20)->unique();
            $table->date('data_nascimento');
            $table->float('altura');
            $table->enum('sexo', ['F', 'M'])->default('M');
            $table->string('celular', 20)->nullable()->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('cpf');
            $table->dropColumn('idade_metabolica');
            $table->dropColumn('altura');
            $table->dropColumn('sexo');
            $table->dropColumn('celular');
        });
    }
};
