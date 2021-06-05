<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donatur extends Model
{
    public $table = "donatur";
    public $timestamps = false;
    protected $fillable = ['nama_donatur','email','no_telepon','jumlah_donasi','status','dibuat_tanggal'];
    protected $primaryKey = "id_donatur";
    use HasFactory;
}
