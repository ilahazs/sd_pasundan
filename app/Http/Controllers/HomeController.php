<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Home;

class HomeController extends Controller
{
    public function index()
    {
        $home = Home::all();
        $totalImage = $home->where('type', '=', 'image')->count();
        for ($i=1; $i < $totalImage+1; $i++) { 
            $data['image_'.$i] = $home->where('section', '=', 'image_'.$i)->first();
            $data['image_'.$i] = $data['image_'.$i]->content;
        }
        return view('welcome', $data);
    }
}
