<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\StudentClass;
use App\Models\CourseSchedule;
use DataTables;
use Hash;

class ProfileController extends Controller
{
    public function myProfile()
    {
        $user = auth()->user();
        if ($user->role == 'teacher'){
            $data['user'] = Teacher::where('user_id', '=', $user->id)->first();
            if($data['user']->profile_image == null){
                $data['user']->profile_image = 'user-default-profile.png';
            }
            $data['user']->name = strtoupper($data['user']->name);
            return view('profile.teacher', $data);
        }
        elseif ($user->role == 'student') {
            $data['user'] = Student::where('user_id', '=', $user->id)->first();
            if($data['user']->profile_image == null){
                $data['user']->profile_image = 'user-default-profile.png';
            }
            $data['user']->name = strtoupper($data['user']->name);
            $data['class'] = StudentClass::where('student_id', '=', $data['user']->id)->first();
            // return $data;
            return view('profile.student', $data);
        }
        else {
            return redirect('admin/dashboard');
        }
        return $user;
    }
    public function getSchedule(Request $request)
    {
        if ($request->ajax()) {
            $data = CourseSchedule::where('class_id', '=', $request->class_id)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);;
        }
    }
    public function editPassword($id)
    {
        $data = User::find($id);
        return response()->json($data);
    }
    public function storePassword(Request $request, $id)
    {
        $data = User::find($id);
        if(!\Hash::check($request->old_password, $data->password)){
            return response()->json(['error' => 'Kamu memasukan password yang salah']);
        }
        $data->password = Hash::make($request->new_password);
        $data->update();
        return response()->json(['success' => 'Berhasil mengubah password']);
    }
}