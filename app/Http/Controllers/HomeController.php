<?php

namespace App\Http\Controllers;

use App\Models\Video;

class HomeController extends Controller
{
    public function __invoke()
    {
        $videos = Video::latest()->get();
        return view('home', [
            'videos' => $videos,
        ]);
    }
}
