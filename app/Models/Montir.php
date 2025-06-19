<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Montir extends Model
{
    use HasFactory;
    protected $table = 'montir';
    protected $guarded = [];

    public function kategoriMontir()
    {
        return $this->belongsTo(KategoriMontir::class, 'kategori_montir_id');
    }
}
