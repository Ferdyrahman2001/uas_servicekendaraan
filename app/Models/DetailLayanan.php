<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailLayanan extends Model
{
    protected $table = 'detail_layanan';
    protected $guarded = [];

    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'layanan_id');
    }

    public function montir()
    {
        return $this->belongsTo(Montir::class, 'montir_id');
    }
}
