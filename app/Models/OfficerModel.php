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
        'branch_id',
        'company_id',
        'fname',
        'mname',
        'lname',

    ];

    public function branch()
    {
        return $this->belongsTo(BranchModel::class, 'branch_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'uid');
    }

   
}
