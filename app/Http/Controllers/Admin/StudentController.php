<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Student;
use App\User;
use DataTables;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['siswa'] = Student::all();
        return view('siswa.index', $data);
    }

    public function tableSiswa(Request $request)
    {
        $data = Student::select('*');
        // dd($data);
        return DataTables::eloquent($data)->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('siswa.add');
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
            'nis' => 'required|unique:student',
            'nisn' => 'required|unique:student',
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
        $user->role = 'student';
        if($user->save()){
            $student = new Student;
            $student->name = $input['name'];
            $student->nis = $input['nis'];
            $student->nisn = $input['nisn'];
            $student->gender = $input['gender'];
            $student->phone = '+62'.$input['phone'];
            $student->user_id = $user->id;
            $student->save();
        }
        return redirect('admin/student');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return 'show siswa';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['siswa'] = Student::find($id);
        $data['siswa']->phone = ltrim($data['siswa']->phone, '+62');
        $data['user'] = User::find($data['siswa']->user_id);

        return view('siswa.edit', $data);
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
        $request->validate([
            'name' => 'required',
            'nis' => 'required',
            'nisn' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'email' => 'required',
        ]);

        $input = $request->all();
        
        //insert to user
        $student = Student::find($id);
        $student->name = $input['name'];
        $student->nis = $input['nis'];
        $student->nisn = $input['nisn'];
        $student->gender = $input['gender'];
        $student->phone = '+62'.$input['phone'];

        $user = User::find($student->user_id);
        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->role = 'student';
        if($input['password']){
            $request->validate([
                'password' => 'required|min:8',
            ]);
            $user->password = Hash::make($input['password']);
        }            
        if($user->update()){
            $student->update();
        }
        return redirect('admin/student');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $siswa = Student::find($id);
        if($siswa){
            $user = User::find($siswa->user_id);
            $siswa->delete();
            if($user){
                $user->delete();
            }
        }
        else {
            return redirect('admin/student');
        }
        return redirect('admin/student');
    }
}
