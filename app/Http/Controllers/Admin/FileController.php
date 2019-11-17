<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\File\UploadRequest;
use App\Models\BucketFile;
use App\Services\StorageFile;

class FileController extends Controller
{
    public function index()
    {
        $model = BucketFile::orderBy('id', 'desc')->get();
        return view('admin.file.index', ['model' => $model]);
    }

    public function create()
    {
        return view('admin.file.edit', ['model' => new BucketFile()]);
    }

    public function edit(BucketFile $model)
    {
        return view('admin.file.edit', ['model' => $model]);
    }

    /**
     * Upload file to bucket
     *
     * @param UploadRequest $request
     * @param StorageFile $storageFile
     * @return \Illuminate\Http\RedirectResponse
     */
    public function upload(UploadRequest $request, StorageFile $storageFile)
    {
        $bucketId = $request->bucket_id;
        $path = $request->file->getRealPath();
        $name = $request->file->getClientOriginalName();

        $storageFile->upload($bucketId, $path, $name);

        return redirect()->back();
    }
}
