<?php


namespace App\Contracts;


interface StorageImage
{
    public function url(string $url);
    public function upload();
}
