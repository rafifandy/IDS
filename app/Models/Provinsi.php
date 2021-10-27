<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    use HasFactory;
    
    protected $table = 'tbl_provinsi';
    protected $primaryKey = 'id';
    protected $fillable = ['id','provinsi','ibukota','p_bsni'];
    
    public $timestamps = false;
    public $incrementing = false;

    public function kabupaten()
    {
        return $this->hasMany(Kelurahan::class,'id');
    }
}