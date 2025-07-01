<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SosialMedia extends Model
{
    use HasFactory;
    protected $table = 'sosial_medias';

    protected $fillable = ['id_user', 'instagram', 'tiktok', 'facebook', 'x'];
}
