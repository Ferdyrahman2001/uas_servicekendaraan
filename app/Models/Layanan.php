<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Layanan extends Model
{
    protected $table = 'layanan';
    protected $guarded = [];

    public function detailLayanans()
    {
        return $this->hasMany(DetailLayanan::class, 'layanan_id');
    }
}
