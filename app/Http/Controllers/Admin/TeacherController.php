<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

use App\Models\Teacher;
use App\User;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['teacher'] = Teacher::all();
        return view('teacher.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teacher.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'nip' => 'required|unique:teacher',
            'gender' => 'required',
            'phone' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:8',
        ]);
        $input = $request->all();
        
        //insert to user
        $user = New User;
        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->password = Hash::make($input['password']);
        $user->role = 'teacher';
        if($user->save()){
            $teacher = new Teacher;
            $teacher->name = $input['name'];
            $teacher->nip = $input['nip'];
            $teacher->gender = $input['gender'];
            $teacher->phone = '+62'.$input['phone'];
            $teacher->user_id = $user->id;
            $teacher->save();
        }
        return redirect('admin/teacher');
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
        if (auth()->user()->role == 'teacher') {
            $validation = Teacher::where('user_id', auth()->user()->id)->first();
            if ($validation->id != $id) {
                return redirect()->back();
            }
        }
        $data['teacher'] = Teacher::find($id);
        $data['teacher']->phone = ltrim($data['teacher']->phone, '+62');
        if($data['teacher']->profile_image == null){
            $data['teacher']->profile_image = 'user-default-profile.png';
        }
        
        $data['user'] = User::find($data['teacher']->user_id);
        return view('teacher.edit',$data);
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
        if (auth()->user()->role == 'teacher') {
            $validation = Teacher::where('user_id', auth()->user()->id)->first();
            if ($validation->id != $id) {
                return redirect()->back();
            }
        }
        $request->validate([
            'name' => 'required',
            'nip' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'email' => 'required',
        ]);

        $input = $request->all();
        
        //insert to teacher
        $teacher = Teacher::find($id);
        $teacher->name = $input['name'];
        $teacher->nip = $input['nip'];
        $teacher->gender = $input['gender'];
        $teacher->phone = '+62'.$input['phone'];
        if(!empty($request->file('profile_image')))
        {
            $image = $request->file('profile_image');
            $filename = time()."_".$image->getClientOriginalName();
            $folderDest = 'img/profile-image';
            $image->move($folderDest,$filename);
            // return $filename;
            $teacher->profile_image = $filename;
        }

        $user = User::find($teacher->user_id);
        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->role = 'teacher';
        if($input['password']){
            $request->validate([
                'password' => 'required|min:8',
            ]);
            $user->password = Hash::make($input['password']);
        }            
        if($user->update()){
            $teacher->update();
        }
        
        if (auth()->user()->role == 'teacher') {
            return redirect('/profile/myProfile');
        }
        return redirect('admin/teacher');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $teacher = Teacher::find($id);
        if($teacher){
            $user = User::find($teacher->user_id);
            $teacher->delete();
            if($user){
                $user->delete();
            }
        }
        else {
            return redirect('admin/teacher');
        }
        return redirect('admin/teacher');
    }
}
