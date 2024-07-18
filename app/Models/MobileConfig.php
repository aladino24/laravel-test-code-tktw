<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobileConfig extends Model
{
    use HasFactory;

    protected $table = 'mobileconfig';

    protected $fillable = [
        'ID',
        'BranchCode',
        'Name',
        'Description',
        'Value',
    ];

    public $timestamps = false;
}
