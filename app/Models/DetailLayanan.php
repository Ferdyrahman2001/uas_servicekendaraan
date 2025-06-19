<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailLayanan extends Model
{
    protected $table = 'detail_layanan';
    protected $guarded = [];

    public function layanan()
    {
        return $this->belongsTo(Layanan::class);
    }

    public function montir()
    {
        return $this->belongsTo(Montir::class);
    }
}
