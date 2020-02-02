<?php

namespace App\Http\Controllers\API\File;

use App\Http\Controllers\Controller;
use App\Http\Resources\BucketFile\BucketFileCollection;
use App\Http\Resources\BucketFile\BucketFileResource;
use App\Http\Resources\File\FileResource;
use App\Models\BucketFile;
use App\Models\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * List of file buckets
     *
     * @param Request $request
     * @return BucketFileCollection
     */
    public function index(Request $request)
    {
        if ($_GET(['bucket_id']) ){
            $model = BucketFile::find($_GET(['bucket_id'])->files->paginate(3);
        } else {
            $model = File::paginate(3);
        }

        return new BucketFileCollection($model);
    }

    /**
     * Get one file bucket
     *
     * @param Request $request
     * @param File $model
     *
     * @return FileResource
     */
    public function show(Request $request, File $model)
    {
        return new FileResource($model);
    }
}
