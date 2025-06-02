<?php

namespace App\Models;

use App\Models\Penilaian;
use App\Models\SubKriteria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kriteria extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'label'];

    public function subKriterias()
    {
        return $this->hasMany(SubKriteria::class);
    }

    public function penilaians()
    {
        return $this->hasMany(Penilaian::class);
    }
}
