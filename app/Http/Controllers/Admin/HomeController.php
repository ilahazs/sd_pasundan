<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use URL;
use Storage;
use App\Models\Home;

class HomeController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['home'] = Home::all();
        return view('master.home.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['section'] = [
            'Header-back',
            'Carousel-image',
            'Carousel-caption',
        ];
        return view('master.home.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $home = new Home;
        $home->section = $input['section'];
        $home->type = $input['type'];
        if($input['type'] == 'image'){
            $image = $request->file('content');
            $nama_file = time()."_".$image->getClientOriginalName();
            $tujuan_upload = 'landing-page/image';
            Storage::put($tujuan_upload, $fileContents);
            $home->content = $nama_file;
        }
        else{
            $home->content = $input['content'];
        }
        $home->save();
        return redirect()->route('master.home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Home::find($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $home = Home::find($id);
        $url = URL::to('/');
        if($home['type'] == 'image'){
            $image = $request->file('content');
            $nama_file = time()."_".$image->getClientOriginalName();
            $tujuan_upload = public_path().'/landing-page/image';
            // Storage::put($tujuan_upload, $image);
            $image->move($tujuan_upload, $nama_file);
            $home->content = $nama_file;
        }
        else{
            $home->content = $input['content'];
        }
        $home->save();
        return redirect()->route('master.home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $home = Home::find($id);
        if($home->count() > 0){
            $home->delete();
        }
        return redirect()->back();
    }
}
