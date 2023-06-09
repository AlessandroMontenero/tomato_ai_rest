<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Articolo extends Model
{
    use HasFactory;

    protected $table = 'fl_listino_acquisto';

    public function prodotto(): BelongsTo
    {
        return $this->belongsTo(Prodotto::class);
    }
}
