@extends('layouts.app')

@section('title', 'Master Home')

@section('head')
<link href="{{asset('css/plugins/dataTables/datatables.min.css')}}" rel="stylesheet">
<link href="{{asset('css/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">
<link href="{{asset('css/plugins/select2/select2.min.css')}}" rel="stylesheet">
<link href="{{asset('css/plugins/select2/select2-bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('heading')
<h2>Master Data Home</h2>
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{url('/')}}">Home</a>
    </li>
    <li class="breadcrumb-item">
        <strong>Master Home</strong>
    </li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Master Data Home</h5>
                <!-- <div class="ibox-tools mb-10">
                    <a href="{{route('home.create')}}" class="mr-4 btn btn-primary btn-sm">
                        Add Data
                    </a>
                </div> -->
            </div>
            <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-striped dataTables">
                        <thead>
                            <tr>
                                <th>Section</th>
                                <th>Content</th>
                                <th>Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($home as $row)
                            <tr>
                                <td>{{$row->section}}</td>
                                <td>{{$row->content}}</td>
                                <td>{{$row->type}}</td>
                                <td class="dataTables-empty">
                                    <div class="btn-group">
                                        <a href="home/{{$row->id}}/edit" class="btn-warning btn btn-sm mr-2"
                                            data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                class="fa fa-edit"></i></a>
                                        <!-- <a href="home/{{$row->id}}/delete"
                                            class="edit btn btn-danger btn-sm delete-btn mr-2" data-toggle="tooltip"
                                            data-placement="top" title="Delete"><i class="fa fa-trash"></i></a> -->
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
</div>
@endsection