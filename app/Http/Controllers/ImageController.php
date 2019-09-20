<?php

namespace App\Http\Controllers;

use App\Models\BucketImage;
use Illuminate\Http\Request;
//use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    public function index(Request $request)
    {
//        Image::make(public_path('img1.png'))->save(public_path('img1.jpg'), 50, 'jpg');
        $model = BucketImage::orderBy('id', 'desc')->get();
        return view('image.index', ['model' => $model]);
    }

    public function create()
    {
        return view('image.edit', ['model' => new BucketImage()]);
    }

    public function edit(BucketImage $model)
    {
        return view('image.edit', ['model' => $model]);
    }
}
