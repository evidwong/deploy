<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $data=["a"=>null];
        dd(data_get($data,'a',' '));
    }
}
