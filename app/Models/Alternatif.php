<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    use HasFactory;

    protected $fillable = ['sampel'];

    public function datasets()
    {
        return $this->hasMany(Dataset::class, 'alternatif_id');
    }

    public function penilaians()
    {
        return $this->hasMany(Penilaian::class);
    }
}
