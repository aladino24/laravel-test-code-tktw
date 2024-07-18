<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customer';

    protected $fillable = [
        'CustID',
        'Name',
        'Address',
        'BranchCode',
        'PhoneNo',
    ];

    public $timestamps = false;

    public function tth()
    {
        return $this->hasMany(CustomerTTH::class, 'CustID', 'CustID');
    }
}
