<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Student;

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
            return view('profile.student', $data);
        }
        else {
            return redirect('admin/dashboard');
        }
        return $user;
    }
}