<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForkomDetails extends Model
{
    use HasFactory;
    protected $table = 'forkoms_details';

    protected $fillable = [
       'id_user',
       'id_forkom',
       'tanggapan',
       'date'
    ];
}
