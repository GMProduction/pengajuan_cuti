<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
        'nip',
        'no_hp',
        'sisa_cuti',
        'alamat',
        'foto',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function cuti() {
        return $this->hasMany(PengajuanCuti::class,'karyawan_id');
    }
}
