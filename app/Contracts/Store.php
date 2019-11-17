<?php


namespace App\Contracts;


interface Store
{
    public function slug(string $path): string;
    public function dstDir(string $hash): string;
}
