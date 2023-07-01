<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Scout\Searchable;

class DepositorModel extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'depositor';

    protected $fillable = [
        'fname',
        'mname',
        'lname',
        'suffix',
        'birth_date',
        'gender',
        'home_address',
        'contact_number',
        'email_add',
        'branch_loc_id',
        'branch_id',
        'referral_id',
        'uploaded_file_id'
    ];
    public function routeNotificationForMail()
    {
        return $this->email_add;
    }

    public function referral(){
        return $this->belongsTo(RefferalModel::class, 'referral_id');
    }

    public function branch(){
        return $this->belongsTo(BranchModel::class, 'branch_id');
    }

    public function location(){
        return $this->belongsTo(BranchLocationModel::class, 'branch_loc_id');
    }

}
