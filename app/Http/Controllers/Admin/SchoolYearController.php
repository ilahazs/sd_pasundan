<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use DataTables;
use App\Models\SchoolYear;

class SchoolYearController extends BaseController
{
    public function __construct(SchoolYear $year)
    {
        $this->yearRepository = $year;
    }
    public function tableYear(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->yearRepository->select('*')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('year', function ($row)
                {
                    $year = $row->start_year.' - '.$row->end_year;
                    return $year;
                })
                ->addColumn('is_active', function ($row)
                {
                $isactive = '<span class="badge badge-danger">Tidak Aktif</span>';
                if($row->isActive == 1){
                    $isactive = '<span class="badge badge-primary">Aktif</span>';
                }
                    return $isactive;
                })
                ->addColumn('action', function ($row)
                {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-warning editYear">Update</a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger deleteYear">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action', 'year', 'is_active'])
                ->make(true);
        }
    }
    
    public function store(Request $request)
    {
        $isActive = "0";
        if($request->isActive){
            $checkYear = $this->yearRepository->where('isActive' , '=', '1')->first();
            if($checkYear){
                $checkYear->update(["isActive" => "0"]);
            }
            $isActive = "1";
        }
        $this->yearRepository->updateOrCreate(
            ['id' => $request->year_id],
            [
                'start_year' => $request->start_year,
                'end_year' => $request->end_year,
                'isActive' => $isActive
            ]
            );
        return response()->json(['success' => 'Tahun ajaran berhasil di simpan']);
    }

    public function edit($id)
    {
        $data = $this->yearRepository->find($id);
        return response()->json($data);
    }
    public function destroy($id)
    {
        $data = $this->yearRepository->find($id);
        if (!$data) {
            return response()->json([
                'error' => 'Data not found.'
            ]);
        }
        if ($data->isActive == 1) {
            return response()->json([
                'error' => 'Tahun ajaran yang sedang aktif tidak bisa dihapus'
            ]);
        }
        $data->delete();
        return response()->json(['success'=>'Tahun ajaran dihapus!']);
    }
}