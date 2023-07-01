<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionStatusModel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'transaction_status';

    public function transactions(){
        return $this->hasMany(TransactionModel::class, 'status_id');
    }
}
