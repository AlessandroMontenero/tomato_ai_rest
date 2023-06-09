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
        Schema::create('fl_listino_acquisto', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_materia');
            $table->tinyInteger('attivo')->default(1);
            $table->integer('fornitore');
            $table->char('codice_fornitore', 100);
            $table->char('formato', 100);
            $table->char('unita_di_misura_formato', 3);
            $table->decimal('valore_di_conversione', 10, 2);
            $table->char('valuta', 3);
            $table->decimal('prezzo_unitario', 10, 4);
            $table->float('iva', 5, 2);
            $table->char('codice_ean', 13);
            $table->decimal('giacenza', 10, 2);
            $table->decimal('giacenza_minima', 10, 2);
            $table->smallInteger('lead_time');
            $table->integer('associa_opzione_linea');
            $table->dateTime('data_creazione');
            $table->dateTime('data_aggiornamento');
            $table->integer('operatore');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fl_listino_acquisto');
    }
};
