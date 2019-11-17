<?php


namespace App\Contracts;


interface StorageFile
{
    public function url(string $url);
    public function upload(int $bucketId, string $path, string $name);
}
