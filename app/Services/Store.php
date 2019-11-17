<?php

namespace App\Services;


use App\Contracts\Store as StoreContract;

class Store implements StoreContract
{
    public function slug(string $path): string
    {
        $sha256 = hash_file('sha256', $path, true);

        return strtr(base64_encode($sha256), '+/=', '._-');
    }

    /**
     * Destination directory path
     *
     * @param $hash
     * @return string
     */
    public function dstDir(string $hash): string
    {
        $path1 = substr($hash, 0, 3);
        $path2 = substr($hash, 3, 3);
        $path3 = substr($hash, 6, 3);
        $dstDir = storage_path("files/{$path1}/{$path2}/{$path3}");

        if(!file_exists($dstDir)) {
            mkdir($dstDir, 0755, true);
        }

        return $dstDir;
    }
}
