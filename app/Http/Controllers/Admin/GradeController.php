<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Grade;
use DataTables;

class GradeController extends BaseController
{
    public function __construct(Grade $grade)
    {
        $this->gradeRepository = $grade;
    }
    
    public function tableGrade(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->gradeRepository->select('*')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row)
                {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-warning editGrade">Update</a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger deleteGrade">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    public function store(Request $request)
    {
        $this->gradeRepository->updateOrCreate(
            ['id' => $request->grade_id],
            [
                'grade' => $request->grade_name
            ]
            );
        return response()->json(['success' => 'Grade saved successfully.']);
    }
    public function edit($id)
    {
        $data = $this->gradeRepository->find($id);
        return response()->json($data);
    }
    public function destroy($id)
    {
        $data = $this->gradeRepository->find($id);
        if (!$data) {
            return response()->json([
                'error' => 'Data not found.'
            ]);
        }
        $data->delete();
        return response()->json(['success'=>'Grade deleted successfully.']);
    }
}
