<?php

namespace App\Http\Controllers\API\File;

use App\Http\Controllers\Controller;
use App\Http\Resources\BucketFile\BucketFileCollection;
use App\Http\Resources\BucketFile\BucketFileResource;
use App\Models\BucketFile;
use Illuminate\Http\Request;

class BucketFileController extends Controller
{
    /**
     * List of file buckets
     *
     * @param Request $request
     * @return BucketFileCollection
     */
//    public function index(Request $request, int $bucketId = null)
    public function index(Request $request, int $bucketId = null)
    {
//        if($bucketId){
//
//        }

        $model = BucketFile::sort()->paginate(3);

        return new BucketFileCollection($model);
    }

    /**
     * Get one file bucket
     *
     * @param Request $request
     * @param BucketFile $model
     *
     * @return BucketFileResource
     */
    public function show(Request $request, BucketFile $model)
    {
        return new BucketFileResource($model);
    }
}
