<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficerModel extends Model
{
    use HasFactory;
    protected $table = 'officer';

    protected $fillable = [
        'uid',
        'branch_loc_id',
        'branch_id',
        'company_id',
        'fname',
        'mname',
        'lname',

    ];
}
