<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class TransactionModel extends Model
{
    use HasFactory; //Searchable
    protected $table = 'transaction';

    protected $fillable = [
        'depositor_id',
        'level_id',
        'status_id',
        'verified_by',
        'approved_by',
        'disapproved_by',
        'verified_at',
        'approved_at',
        'disapproved_at',
        'remarks',

    ];

    public function depositor()
    {
        return $this->belongsTo(DepositorModel::class, 'depositor_id');
    }

    public function level()
    {
        return $this->belongsTo(LevelModel::class, 'level_id');
    }

    public function status()
    {
        return $this->belongsTo(TransactionStatusModel::class, 'status_id');
    }

    public function approved()
    {
        return $this->belongsTo(OfficerModel::class, 'approved_by')->withDefault();
    }

    public function verified()
    {
        return $this->belongsTo(OfficerModel::class, 'verified_by')->withDefault();
    }

    public function branch()
    {
        return $this->depositor->belongsTo(BranchModel::class, 'branch_id');
    }

    public function branch_loc()
    {
        return $this->depositor->belongsTo(BranchLocationModel::class, 'branch_loc_id');
    }

    public function referral()
    {
        return $this->depositor->belongsTo(RefferalModel::class, 'referral_id')->withDefault();
    }

    public function referral_branch()
    {
        return $this->depositor->referral->belongsTo(BranchModel::class, 'r_branch_id')->withDefault();
    }

    public function uploaded_files()
    {
        return $this->depositor->belongsTo(UploadedFileModel::class, 'uploaded_file_id');
    }

  /* public function toSearchableArray()
   {
       $array = $this->toArray();
       if ($this->depositor) {
           $array['depositor_fname'] = $this->depositor->fname;
           $array['depositor_mname'] = $this->depositor->mname;
           $array['depositor_lname'] = $this->depositor->lname;
           $array['depositor_branch'] = $this->depositor->branch_id;
       }
       unset($array['depositor']);
       return $array;

   }*/
}
