<?php


namespace App\Contracts;


interface Store
{
    public function randomSlug(): string;
    public function hashPath(string $hash): string;
    public function dstDir(string $hash): string;
}
