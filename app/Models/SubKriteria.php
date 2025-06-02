<?php

namespace App\Models;

use App\Models\Kriteria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubKriteria extends Model
{
    use HasFactory;

    protected $fillable = ['kriteria_id', 'nama', 'nilai'];

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }
}
