<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sanggar extends Model
{
    use HasFactory;

    protected $table = 'sanggar';

    protected $fillable = [
        'kode_sanggar',
        'nama_sanggar',
        'bidang_garapan_seni',
        'jalan_rt_rw',
        'desa_kel',
        'kecamatan',
        'no_sk',
        'tahun_sk',
        'jabatan_penandatangan',
        'nama_penandatangan',
        'nama_pimpinan',
        'jenis_kelamin',
        'nik',
        'no_hp',
        'jumlah_anggota',
        'status',
        'user_id',
        'nomor_induk_kebudayaan',
        'keterangan_status',
        'foto',
    ];



    // Generate kode otomatis saat membuat data baru
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($sanggar) {
            $last = self::latest('id')->first();
            $nextId = $last ? $last->id + 1 : 1;
            $sanggar->kode_sanggar = 'SNG-' . date('Y') . '-' . str_pad($nextId, 3, '0', STR_PAD_LEFT);
        });
    }
}
