<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerTTHDetail extends Model
{
    use HasFactory;

    protected $table = 'customertthdetail';

    protected $fillable = [
        'ID',
        'TTHNo',
        'TTOTTPNo',
        'Jenis',
        'Qty',
        'Unit',
    ];

    public $timestamps = false;

    public function tth()
    {
        return $this->belongsTo(CustomerTTH::class, 'TTHNo', 'TTHNo');
    }
}
