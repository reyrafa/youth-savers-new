<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadedFileModel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'uploaded_file';
    protected $fillable = [
        'signature_img',
        'identification_img',
        'birth_cert_img',
        'receipt_img',
    ];
}
