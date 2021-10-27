<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;
    
    protected $table = 'tbl_kecamatan';
    protected $primaryKey = 'id';
    protected $fillable = ['id','kabkot_id','kecamatan'];
    
    public $timestamps = false;
    public $incrementing = false;

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class,'kabkot_id');
    }
    public function kelurahan()
    {
        return $this->hasMany(Kelurahan::class,'id');
    }
}