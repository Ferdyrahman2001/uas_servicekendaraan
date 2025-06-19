<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $table = 'layanan';
    protected $guarded = [];

    public function detailLayanans()
    {
        return $this->hasMany(DetailLayanan::class, 'layanan_id');
    }
}
