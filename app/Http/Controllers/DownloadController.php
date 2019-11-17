<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DownloadController extends Controller
{
    public function file(Request $request, string $slug)
    {
        dump(Cache::get('file/123', 'default'));
        Cache::forever('file/123', 'value/file/123');
//        dd('Download file');
    }

    public function image(string $slug)
    {
        dd('Download image');
    }
}
