<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    protected $primaryKey = 'province_id';
    public $timestamps = false;
    
    protected $fillable = [
        'province_id',
        'province'
    ];
}
