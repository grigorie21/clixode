<?php


namespace App\Contracts;


interface Storage
{
    public function put(string $srcPath);
    public function get(string $id);
}
