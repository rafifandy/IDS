<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    use HasFactory;
    
    protected $table = 'tbl_kabkot';
    protected $primaryKey = 'id';
    protected $fillable = ['id_kab','provinsi_id','kabupaten_kota','ibukota', 'k_bsni'];
    
    public $timestamps = false;
    public $incrementing = false;

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class,'provinsi_id');
    }
    public function kabupaten()
    {
        return $this->hasMany(Kelurahan::class,'id');
    }
}