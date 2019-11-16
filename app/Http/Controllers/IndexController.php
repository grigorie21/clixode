<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index() {
        $sha256 = hash('sha256', '123', true);
        $slug = strtr(base64_encode(base64_encode($sha256)), '+/=', '._-');
//        dd($hash);
        return view('index');
    }
}
