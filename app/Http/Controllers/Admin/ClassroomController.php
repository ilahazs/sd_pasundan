<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use DataTables;
use App\Models\PivotClass;
use App\Models\Grade;
use App\Models\StudentClass;
use App\Models\Student;
use App\Models\GradeVariable;
use App\Models\SchoolYear;

class ClassroomController extends BaseController
{
    public function __construct(PivotClass $class,
                                Grade $grade,
                                StudentClass $student_class,
                                Student $student,
                                GradeVariable $variable,
                                SchoolYear $year)
    {
        $this->classRepository = $class;
        $this->studentClassRepository = $student_class;
        $this->studentRepository = $student;
        $this->gradeRepository = $grade;
        $this->variableRepository = $variable;
        $this->yearRepository = $year;
    }
    public function index(Request $request)
    {
        $row['grade'] = $this->gradeRepository->all();
        $row['variable'] = $this->variableRepository->all();
        $row['year'] = $this->yearRepository->all();
        if($request->ajax()){
            $data = $this->classRepository->select('*')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row)
                {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Detail" class="btn btn-primary detailClass">Detail</a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-warning editClass">Update</a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger deleteClass">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('classroom.index', $row);
    }

    public function store(Request $request)
    {
        $this->classRepository->updateOrCreate(
            ['id' => $request->class_id],
            [
                'grade_id' => $request->grade_id,
                'variable_id' => $request->variable_id,
                'year_id' => $request->year_id,
            ]);
        return response()->json(['success' => 'Class saved successfully.']);
    }

    public function edit($id)
    {
        $data = $this->classRepository->find($id);
        return response()->json($data);
    }
    
    public function destroy($id)
    {
        $data = $this->classRepository->find($id);
        if (!$data) {
            return response()->json([
                'error' => 'Data not found.'
            ]);
        }
        $data->delete();
        return response()->json(['success'=>'Class deleted successfully.']);
    }

    public function detail($id)
    {
        $data['class'] = $this->classRepository->find($id);
        
        return view('classroom.detail', $data);
    }

    public function getStudent($id)
    {
        $student_in_class = \DB::table('student_class')->where('class_id', '=', $id)->pluck('student_id');
        $data = $this->studentRepository->whereNotIn('id', $student_in_class)->get();
        return response()->json($data);
    }
    
    public function tableStudent($id, Request $request)
    {
        if($request->ajax()){
            $data = $this->studentClassRepository->where('class_id', '=', $id)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row)
                {
                    $btn = '<a href="' . route('student') . '/' . $row->student_id . '/edit" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-warning editStudent">Update</a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger deleteStudent">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function addStudent(Request $request, $id)
    {
        $student_id = $request->student_id;
        $response = ["success" => "Class saved successfully."];
        foreach ($student_id as $student) {
            if($this->studentClassRepository->where('student_id', '=', $student)->count() > 0){
                $response = ['error' => 'Siswa telah terdaftar pada suatu kelas.'];
            };
            $this->studentClassRepository->updateOrCreate(
                ['id' => $request->sc_id],
                [
                    'student_id' => $student,
                    'class_id' => $id
            ]);
        }
        return response()->json($response);
    }

    public function removeStudent(Request $request, $id)
    {
        $data = $this->studentClassRepository->find($id);
        if (!$data) {
            return response()->json([
                'error' => 'Data not found.'
            ]);
        }
        $data->delete();
        return response()->json(['success'=>'Student deleted successfully.']);
    }
}