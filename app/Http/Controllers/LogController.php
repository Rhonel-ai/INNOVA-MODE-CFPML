<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LogController extends Controller
{
    public function index(){
        $logs= File::get(storage_path('logs/laravel.log'));
        $logs=explode('\n',$logs);
        return view('logs',['logs'=>$logs]);
    }
} 