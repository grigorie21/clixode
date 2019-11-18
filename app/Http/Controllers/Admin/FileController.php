<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\File\UploadRequest;
use App\Models\BucketFile;
use App\Models\FileM2MBucket;
use App\Services\StorageFile;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FileController extends Controller
{
    /**
     * List of the buckets
     *
     * @return Factory|View
     */
    public function index()
    {
        $model = BucketFile::orderBy('id', 'desc')->get();
        return view('admin.file.index', ['model' => $model]);
    }

    public function create()
    {
        return view('admin.file.edit', ['model' => new BucketFile()]);
    }

    /**
     * Edit bucket
     *
     * @param BucketFile $model
     * @return Factory|View
     */
    public function edit(BucketFile $model)
    {
        $model->load(['files' => function ($query) {
            $query->orderBy('id', 'desc');
            $query->withPivot('id', 'name', 'created_at', 'slug');
        }]);

        return view('admin.file.edit', ['model' => $model]);
    }

    /**
     *
     */
    public function show()
    {

    }

    /**
     * Upload file to bucket
     *
     * @param UploadRequest $request
     * @param StorageFile $storageFile
     * @return RedirectResponse
     */
    public function upload(UploadRequest $request, StorageFile $storageFile)
    {
        $bucketId = $request->bucket_id;
        $path = $request->file->getRealPath();
        $name = $request->file->getClientOriginalName();

        $storageFile->upload($bucketId, $path, $name);

        return redirect()->back();
    }

    /**
     * Delete file from bucket
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(int $id)
    {
        FileM2MBucket::destroy($id);
        return redirect()->back();
    }
}
