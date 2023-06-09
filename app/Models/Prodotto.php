<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Prodotto extends Model
{
    use HasFactory;
    protected $table = 'cc_prodotti';

    public function articoli(): HasMany
    {
        return $this->hasMany(Articolo::class, 'id_materia');
    }


}
