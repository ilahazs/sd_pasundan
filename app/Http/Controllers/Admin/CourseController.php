<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Models\Course;
use DataTables;

class CourseController extends BaseController
{
    public function __construct(Course $course)
    {
        $this->courseRepository = $course;
    }
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Course::select('*')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row)
                {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-warning editCourse">Update</a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger deleteCourse">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('course.index');
    }

    public function store(Request $request)
    {
        $course_name = $request->course_name;
        if ($request->course_code) {
            $course_code = $request->course_code;
        }
        else{
            if (str_contains(strtoupper($course_name), 'INDONESIA')) {
                $course_code = $this->courseCodeGenerator('Indonesia');
            }
            else if (str_contains(strtoupper($course_name), 'ENGLISH') || str_contains(strtoupper($course_name), 'INGGRIS')) {
                $course_code = $this->courseCodeGenerator('Inggris');
            }
            else{
                $course_code = $this->courseCodeGenerator($course_name);
            }
        }

        $this->courseRepository->updateOrCreate(
            ['id' => $request->course_id],
            [
                'course_code' => $course_code,
                'course_name' => $course_name
            ]);
        return response()->json(['success' => 'Course saved successfully.']);

        
    }

    public function edit($id)
    {
        $data = Course::find($id);
        return response()->json($data);
    }
    
    public function destroy($id)
    {
        $data = Course::find($id);
        if (!$data) {
            return response()->json([
                'error' => 'Data not found.'
            ]);
        }
        $data->delete();
        return response()->json(['success'=>'Course deleted successfully.']);
    }
}
