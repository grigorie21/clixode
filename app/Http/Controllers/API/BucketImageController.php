<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\BucketImage\BucketImageCollection;
use App\Http\Resources\BucketImage\BucketImageResource;
use App\Models\BucketImage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BucketImageController extends Controller
{
    /**
     * List of image buckets
     *
     * @param Request $request
     * @return BucketImageCollection
     */
    public function index(Request $request)
    {
        $model = BucketImage::sort()->paginate();

        return new BucketImageCollection($model);
    }

    /**
     * Get one image bucket
     *
     * @param Request $request
     * @param BucketImage $model
     *
     * @return BucketImageResource
     */
    public function show(Request $request, BucketImage $model)
    {
        return new BucketImageResource($model);
    }
}
