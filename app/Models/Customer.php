<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    
    protected $table = 'tbl_customer';
    protected $primaryKey = 'id_cust';
    protected $fillable = ['id_cust','nama','alamat','foto','path','id_kel'];
    
    public $timestamps = false;
    public $incrementing = false;

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class,'id_kel');
    }
}