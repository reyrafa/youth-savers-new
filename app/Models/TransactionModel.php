<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionModel extends Model
{
    use HasFactory;
    protected $table = 'transaction';

    protected $fillable = [
        'depositor_id',
        'level_id',
        'status_id',
        'officer_id',
        'remarks',

    ];
}
