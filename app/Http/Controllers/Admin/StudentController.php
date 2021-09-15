<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Student;
use App\User;
use DataTables;
use Illuminate\Support\Facades\Hash;

class StudentController extends BaseController
{
    public function __construct(Student $student)
    {
        $this->studentRepository = $student;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['student'] = $this->studentRepository->all();
        return view('student.index', $data);
    }

    public function tableStudent(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->studentRepository->select('*')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="student/' . $row->id . '/edit" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-warning editStudent">Update</a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger deleteStudent">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student.add');
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
        $user = new User;
        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->password = Hash::make($input['password']);
        $user->role = 'student';
        if ($user->save()) {
            $student = new Student;
            $student->name = $input['name'];
            $student->nis = $input['nis'];
            $student->nisn = $input['nisn'];
            $student->gender = $input['gender'];
            $student->phone = '+62' . $input['phone'];
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
        $data['siswa'] = $this->studentRepository->find($id);
        $data['siswa']->phone = ltrim($data['siswa']->phone, '+62');
        $data['user'] = User::find($data['siswa']->user_id);

        return view('student.edit', $data);
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
        $student = $this->studentRepository->find($id);
        $student->name = $input['name'];
        $student->nis = $input['nis'];
        $student->nisn = $input['nisn'];
        $student->gender = $input['gender'];
        $student->phone = '+62' . $input['phone'];

        $user = User::find($student->user_id);
        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->role = 'student';
        if ($input['password']) {
            $request->validate([
                'password' => 'required|min:8',
            ]);
            $user->password = Hash::make($input['password']);
        }
        if ($user->update()) {
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
        $siswa = $this->studentRepository->find($id);
        if ($siswa) {
            $user = User::find($siswa->user_id);
            $siswa->delete();
            if ($user) {
                $user->delete();
            }
        } else {
            return response()->json([
                'error' => 'Data not found.'
            ]);
        }
        return response()->json(['success' => 'Grade deleted successfully.']);
    }
}
