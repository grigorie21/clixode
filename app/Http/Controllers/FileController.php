<?php

namespace App\Http\Controllers;

use App\Http\Requests\API\File\UploadRequest;
use App\Models\BucketFile;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function index()
    {
        $model = BucketFile::orderBy('id', 'desc')->get();
        return view('file.index', ['model' => $model]);
    }

    public function create()
    {
        return view('file.edit', ['model' => new BucketFile()]);
    }

    public function edit(BucketFile $model)
    {
        return view('file.edit', ['model' => $model]);
    }
}
