<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AyatTerakhir extends Model
{
    use HasFactory;
    protected $table = 'ayat_terakhirs';

    protected $fillable = ['id_user', 'id_surah', 'nama_surah', 'ayat_terakhir'];
}
