<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sepeda extends Model
{
    use HasFactory;

    protected $table = 'table_sepeda';
    public $timestamps = false;

    protected $fillable = [
        'nama_sepeda',
        'merk_sepeda',
        'jenis_sepeda',
        'peruntukan',
        'jumlah_speed',
        'tanggal_launching'
    ];
}
