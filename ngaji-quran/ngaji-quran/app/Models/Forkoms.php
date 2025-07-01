<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forkoms extends Model
{
    use HasFactory;

    protected $table = 'forkoms';

    protected $fillable = [
        'id_user',
        'judul',
        'pertanyaan',
        'date',
    ];
}
