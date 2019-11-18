<?php

namespace App\Http\Controllers;


use App\Contracts\Store;
use App\Models\FileM2MBucket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DownloadController extends Controller
{
    protected $store;

    public function __construct(Store $store)
    {
        $this->store = $store;
    }

    public function file(string $slug)
    {
        if ($cache = Cache::get("FILE:{$slug}")) { // search file in cache
            $hash = $cache->file->sha256;
            $hashPath = $this->store->hashPath($hash);

            return response(null, 200)
                ->header('X-Accel-Redirect', "/storage/files/{$hashPath}/{$hash}")
                ->header('Content-Type', 'application/octet-stream')
                ->header('Content-Disposition', "attachment; filename=\"{$cache->file_bucket->name}\"");
        } else {
            if ($fileM2MBucket = FileM2MBucket::where('slug', $slug)->with('file')->first()) { // caching file
                Cache::forever("FILE:{$slug}", (object)[
                    'file_bucket' => $fileM2MBucket,
                    'file' => $fileM2MBucket->file,
                ]);

                $hash = $fileM2MBucket->file->sha256;
                $hashPath = $this->store->hashPath($hash);

                return response(null, 200)
                    ->header('X-Accel-Redirect', "/storage/files/{$hashPath}/{$hash}")
                    ->header('Content-Type', 'application/octet-stream')
                    ->header('Content-Disposition', "attachment; filename=\"{$fileM2MBucket->name}\"");
            } else {
                dd(404);
                return response(null, 404);
            }
        }
    }

    public function image(string $slug)
    {
        dd('Download image');
    }
}
