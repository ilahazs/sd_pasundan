<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use DataTables;
use App\Models\GradeVariable;

class GradeVariableController extends BaseController
{
    public function __construct(GradeVariable $variable)
    {
        $this->variableRepository = $variable;
    }
    
    public function tableVariable(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->variableRepository->select('*')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row)
                {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-warning editVariable">Update</a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger deleteVariable">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        $this->variableRepository->updateOrCreate(
            ['id' => $request->variable_id],
            [
                'variable' => $request->variable_name
            ]
            );
        return response()->json(['success' => 'Variable saved successfully.']);
    }

    public function edit($id)
    {
        $data = $this->variableRepository->find($id);
        return response()->json($data);
    }
    public function destroy($id)
    {
        $data = $this->variableRepository->find($id);
        if (!$data) {
            return response()->json([
                'error' => 'Data not found.'
            ]);
        }
        $data->delete();
        return response()->json(['success'=>'Variable deleted successfully.']);
    }
}
