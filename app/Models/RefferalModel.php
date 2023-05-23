<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefferalModel extends Model
{
    use HasFactory;
    protected $table = 'referral';
    public $timestamps = false;
    protected $fillable = [
        'r_fname',
        'r_mname',
        'r_lname',
        'r_branch_loc_id',
        'r_branch_id',

    ];
}
