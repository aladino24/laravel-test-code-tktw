<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerTTH extends Model
{
    use HasFactory;
    protected $table = 'customertth';
    protected $primaryKey = 'ID';

    protected $fillable = [
        'TTHNo',
        'SalesID',
        'TTOTTPNo',
        'CustID',
        'DocDate',
        'Received',
        'ReceivedDate',
        'FailedReason',
    ];

    public $timestamps = false;

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'CustID', 'CustID');
    }

    public function details()
    {
        return $this->hasMany(CustomerTTHDetail::class, 'TTOTTPNo', 'TTOTTPNo');
    }
}
