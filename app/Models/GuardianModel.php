<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuardianModel extends Model
{
    use HasFactory;
    protected $table = 'guardian';
    public $timestamps = false;
    protected $fillable = [
        'depositor_id',
        'g_fname',
        'g_mname',
        'g_lname',
        'g_suffix',
        'g_birth_date',
        'g_gender',
        'g_depositor_relation',
        'g_civil_status',
        'g_member_or_not',
        'g_home_address',
        'g_present_address',
        'g_contact_num',
        'g_email_add'
    ];
  
}
