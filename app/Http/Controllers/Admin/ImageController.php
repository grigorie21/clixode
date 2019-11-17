<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BucketImage;
use Illuminate\Http\Request;
//use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    public function index(Request $request)
    {
//        Image::make(public_path('img1.png'))->save(public_path('img1.jpg'), 50, 'jpg');
        $model = BucketImage::orderBy('id', 'desc')->get();
        return view('admin.image.index', ['model' => $model]);
    }

    public function create()
    {
        return view('admin.image.edit', ['model' => new BucketImage()]);
    }

    public function edit(BucketImage $model)
    {
        return view('admin.image.edit', ['model' => $model]);
    }
}
