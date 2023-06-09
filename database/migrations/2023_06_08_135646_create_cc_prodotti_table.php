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
        /* Creo la tabella dei prodotti */
        Schema::create('cc_prodotti', function (Blueprint $table) {
            $table->id();
            $table->integer('anagrafica_id')->default(1);
            $table->tinyInteger('attivo')->default(1);
            $table->tinyInteger('acquista')->default(0);
            $table->tinyInteger('produci')->default(0);
            $table->tinyInteger('stocca')->default(0);
            $table->tinyInteger('vendi')->default(0);
            $table->char('type', 25)->default('FOOD');
            $table->char('categoria', 50);
            $table->char('nome', 50);
            $table->char('um', 3)->default('PZ');
            $table->decimal('costo', $precision = 10, $scale = 2)->nullable()->default(0.00);
            $table->decimal('vendita', $precision = 10, $scale = 2)->nullable()->default(0.00);
            $table->decimal('iva', $precision = 10, $scale = 2)->nullable()->default(10.00);
            $table->decimal('peso', $precision = 10, $scale = 2)->default(0.00);
            $table->integer('tempo_produzione')->nullable()->default(0);
            $table->decimal('unita_prodotte', $precision = 10, $scale = 3)->nullable()->default(1.000);
            $table->integer('shelf_life')->nullable()->default(0);
            $table->decimal('percentuale_scarto', $precision = 10, $scale = 3);
            $table->decimal('giacenza_minima', $precision = 10, $scale = 3);
            $table->decimal('giacenza_attuale', $precision = 10, $scale = 3);
            $table->char('tags');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cc_prodotti');
    }
};
