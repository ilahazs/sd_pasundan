<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\CourseSchedule;
use App\Models\PivotClass;
use App\Models\CourseTeacher;
use App\Models\Day;
use DataTables;

class ScheduleController extends BaseController
{
    public function __construct(CourseSchedule $schedule,
                                PivotClass $classroom,
                                Day $day,
                                CourseTeacher $course)
    {
        $this->scheduleRepository = $schedule;
        $this->classroomRepository = $classroom;
        $this->courseRepository = $course;
        $this->dayRepository = $day;
    }
    
    public function index(Request $request)
    {
        $data1['classroom'] = $this->classroomRepository->get()->sortBy('grade');
        $data1['course'] = $this->courseRepository->get()->sortBy('course_name');
        $data1['day'] = $this->dayRepository->get()->sortBy('id');
        if($request->ajax()){
            $data = $this->scheduleRepository->select('*')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row)
                {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-warning editCourseSchedule">Update</a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger deleteCourseSchedule">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('schedule.index', $data1);
    }
    public function store(Request $request)
    {
        $this->scheduleRepository->updateOrCreate(
            ['id' => $request->cs_id],
            [
                'class_id' => $request->class_id,
                'c_teacher_id' => $request->c_teacher_id,
                'day_id' => $request->day_id,
            ]);
        return response()->json(['success' => 'Schedule saved successfully.']);
    }

    public function edit($id)
    {
        $data = $this->scheduleRepository->find($id);
        return response()->json($data);
    }

    public function destroy($id)
    {
        $data = $this->scheduleRepository->find($id);
        if (!$data) {
            return response()->json([
                'error' => 'Data not found.'
            ]);
        }
        $data->delete();
        return response()->json(['success'=>'Schedule deleted successfully.']);
    }
}