<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\CourseTeacher;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\SchoolYear;
use DataTables;

class CourseTeacherController extends BaseController
{
    public function __construct(CourseTeacher $ct,
                                Course $c,
                                Teacher $t,
                                SchoolYear $sy)
    {
        $this->ctRepository = $ct;
        $this->cRepository = $c;
        $this->tRepository = $t;
        $this->syRepository = $sy;
    }
    
    public function index()
    {
        $row['teacher'] = $this->tRepository->all();
        $row['course'] = $this->cRepository->all();
        $row['year'] = $this->syRepository->all();
        return view('master.course-teacher.index', $row);
    }

    public function tableCourseTeacher(Request $request)
    {
        if($request->ajax()){
            $data = $this->ctRepository->select('*')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row)
                {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-warning editCourseTeacher">Update</a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger deleteCourseTeacher">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        $this->ctRepository->updateOrCreate(
            ['id' => $request->ct_id],
            [
                'teacher_id' => $request->teacher_id,
                'course_id' => $request->course_id,
                'year_id' => $request->year_id,
            ]);
        return response()->json(['success' => 'Course teacher saved successfully.']);
    }

    public function edit($id)
    {
        $data = $this->ctRepository->find($id);
        return response()->json($data);
    }

    public function destroy($id)
    {
        $data = $this->ctRepository->find($id);
        if (!$data) {
            return response()->json([
                'error' => 'Data not found.'
            ]);
        }
        $data->delete();
        return response()->json(['success'=>'Course teacher deleted successfully.']);
    }
}
