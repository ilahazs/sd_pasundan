@extends('layouts.app')

@section('title', 'Manage Guru')

@section('head')
@endsection

@section('heading')
    <h2>Guru</h2>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{url('/')}}">Home</a>
        </li>
        <li class="breadcrumb-item">
            <strong>Table Guru</strong>
        </li>
    </ol>
@endsection

@section('content')
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Table Guru</h5>
                <div class="ibox-tools mb-10">
                    <a href="{{url('admin/teacher/create')}}" class="mr-4 btn btn-primary btn-sm">
                        Add Guru
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-striped dataTables">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>NIP</th>
                                <th>Phone</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($teacher as $row)
                            <tr>
                                <td>{{$row->name}}</td>
                                <td>{{$row->nip}}</td>
                                <td>{{$row->phone}}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="teacher/{{$row->id}}/show" class="btn-dark btn btn-sm mr-2" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye"></i></a>
                                        <a href="teacher/{{$row->id}}/edit" class="btn-warning btn btn-sm mr-2" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                        <a href="teacher/{{$row->id}}/delete" class="edit btn btn-danger btn-sm delete-btn mr-2" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/plugins/dataTables/datatables.min.js')}}"></script>
    <script src="{{asset('js/plugins/dataTables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.4/dist/sweetalert2.all.min.js"></script>
    <script src="{{asset('js/plugins/select2/select2.full.min.js')}}"></script>
    <script>
        
    </script>
@endsection