<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class MasterClassController extends BaseController
{
    public function index()
    {
        return view('master.class.index');
    }
}
