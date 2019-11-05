<?php

namespace App\Http\Controllers;

use App\Jobs\HttpDownload;
use App\Models\BucketFile;
use App\Models\User;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function download() {
        HttpDownload::dispatch();
        return view('index');
    }
    public function index(Request $request)
    {
        $model = BucketFile::orderBy('id', 'desc')->get();
        return view('file.index', ['model' => $model]);
    }

    public function create()
    {
        $userArr = User::pluck('email','id');

        return view('file.edit', [
            'model' => new BucketFile(),
            'userArr' => $userArr
        ]);
    }

    public function edit(Request $model)
    {
        return view('file.edit', ['model' => $model]);
    }

    public function store(Request $request)
    {
       BucketFile::create([
           'title' => $request->title,
           'slug' => $request->slug,
           'user_id' => $request->user_id,
       ]);
    }
}
