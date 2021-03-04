<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Home;

class HomeController extends Controller
{
    public function index()
    {
        $home = Home::all();
        $data['header_back'] = $home->where('section', '=', 'image_1')->first();
        return view('welcome', $data);
    }
}
