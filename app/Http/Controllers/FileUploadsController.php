<?php

namespace App\Http\Controllers;

use App\Models\TemporaryFileModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploadsController extends Controller
{
    /*======================== for signature upload ======================*/
    public function store_signature(Request $req)
    {
        if ($req->hasFile('uploaded_file.signature_img')) {
            $file = $req->file('uploaded_file.signature_img');
            $filename = $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;
            $file->storeAs('public/uploads/signature/', $folder . $filename);

            $temp_file = new TemporaryFileModel();
            $temp_file->file_name = $folder . $filename;
            $temp_file->save();

            return $folder . $filename;
        }

        return '';
    }


    public function delete_signature()
    {
        $file = TemporaryFileModel::where('file_name', request()->getContent())->first();
        $filepath = 'public/uploads/signature/' . $file->file_name;
        if ($file) {
            Storage::delete($filepath);
            $file->delete();
            return response('');
        };
    }

    /*================================ for ID upload ================================*/

    public function store_identification(Request $req)
    {
        if ($req->hasFile('uploaded_file.identification_img')) {
            $file = $req->file('uploaded_file.identification_img');
            $filename = $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;
            $file->storeAs('public/uploads/valid_id/', $folder . $filename);

            $temp_file = new TemporaryFileModel();
            $temp_file->file_name = $folder . $filename;
            $temp_file->save();

            return $folder . $filename;
        }

        return '';
    }


    public function delete_identification()
    {
        $file = TemporaryFileModel::where('file_name', request()->getContent())->first();
        $filepath = 'public/uploads/valid_id/' . $file->file_name;
        if ($file) {
            Storage::delete($filepath);
            $file->delete();
            return response('');
        };
    }

    /*================================ for birth certificate upload ================================*/

    public function store_bcertificate(Request $req)
    {
        if ($req->hasFile('uploaded_file.birth_cert_img')) {
            $file = $req->file('uploaded_file.birth_cert_img');
            $filename = $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;
            $file->storeAs('public/uploads/bcertificate/', $folder . $filename);

            $temp_file = new TemporaryFileModel();
            $temp_file->file_name = $folder . $filename;
            $temp_file->save();
            return $folder . $filename;
        }

        return '';
    }


    public function delete_bcertificate()
    {
        $file = TemporaryFileModel::where('file_name', request()->getContent())->first();
        $filepath = 'public/uploads/bcertificate/' . $file->file_name;
        if ($file) {
            Storage::delete($filepath);
            $file->delete();
            return response('');
        };
    }

    /*================================ for receipt upload ================================*/

    public function store_receipt(Request $req)
    {
        if ($req->hasFile('uploaded_file.receipt_img')) {
            $file = $req->file('uploaded_file.receipt_img');
            $filename = $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;
            $file->storeAs('public/uploads/receipt/', $folder . $filename);

            $temp_file = new TemporaryFileModel();
            $temp_file->file_name = $folder . $filename;
            $temp_file->save();
            return $folder . $filename;
        }

        return '';
    }


    public function delete_receipt()
    {
        $file = TemporaryFileModel::where('file_name', request()->getContent())->first();
        $filepath = 'public/uploads/receipt/' . $file->file_name;
        if ($file) {
            Storage::delete($filepath);
            $file->delete();
            return response('');
        };
    }
}
