<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    use HasFactory;
    
    protected $table = 'tbl_kelurahan';
    protected $primaryKey = 'id';
    protected $fillable = ['id','kecamatan_id','kelurahan','kd_pos'];
    
    public $timestamps = false;
    public $incrementing = false;

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class,'kecamatan_id');
    }
    public function customer()
    {
        return $this->hasMany(Customer::class,'id_cust');
    }
}