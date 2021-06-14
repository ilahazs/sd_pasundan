<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use URL;
use DataTables;
use Storage;
use App\Models\Home;

class HomeController extends BaseController
{
    public function __construct(Home $home)
    {
        $this->homeRepository = $home;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = $this->homeRepository->select('*')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row)
                {
                    $btn = '<a href="javascript:void(0)" id="editContent" class="btn-warning btn btn-sm mr-2" data-toggle="tooltip" data-placement="top" title="Edit" data-id="'.$row->id.'">Edit</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('master.home.index');
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
        $content = null;
        if($home['type'] == 'image'){
            $image = $request->file('content');
            $nama_file = time()."_".$image->getClientOriginalName();
            $tujuan_upload = public_path().'/landing-page/image';
            // Storage::put($tujuan_upload, $image);
            $image->move($tujuan_upload, $nama_file);
            $home->content = $nama_file;
        }
        else{
            return $id;
        }
        $home->save();
        return response()->json(['success'=>'Home updated successfully.']);    
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
