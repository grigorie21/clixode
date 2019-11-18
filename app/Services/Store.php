<?php

namespace App\Services;


use App\Contracts\Store as StoreContract;
use Exception;

class Store implements StoreContract
{
    /**
     * Return path from hash
     *
     * @param string $hash
     * @return string
     */
    public function hashPath(string $hash): string
    {
        $path1 = substr($hash, 0, 3);
        $path2 = substr($hash, 3, 3);
        $path3 = substr($hash, 6, 3);

        return "{$path1}/{$path2}/{$path3}";
    }

    /**
     * Generate random slug
     *
     * @return string
     * @throws Exception
     */
    public function randomSlug(): string
    {
        $randomBytes = random_bytes(2048);
        $hash = hash('sha256', $randomBytes, true);
        $slug = strtr(base64_encode($hash), '+/=', '._-');

        return preg_replace("/\-+/", '', $slug);
    }

    /**
     * Destination directory path
     *
     * @param $hash
     * @return string
     */
    public function dstDir(string $hash): string
    {
        $dstDir = storage_path("files/{$this->hashPath($hash)}");

        if (!file_exists($dstDir)) {
            mkdir($dstDir, 0755, true);
        }

        return $dstDir;
    }
}
