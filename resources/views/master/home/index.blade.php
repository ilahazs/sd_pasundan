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
                    <a href="{{route('master.home.create')}}" class="mr-4 btn btn-primary btn-sm">
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
                                        <a href="javascript:void(0)" id="editContent"
                                            class="btn-warning btn btn-sm mr-2" data-toggle="tooltip"
                                            data-placement="top" title="Edit" data-id="{{$row->id}}">Edit</a>
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
                <div class="modal inmodal" id="contentModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content animated bounceInRight">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span
                                        aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h5 class="modal-title">Tambah Mata Pelajaran</h5>
                            </div>
                            <div class="modal-body">
                                <form id="contentForm" name="contentForm" onkeydown="return event.key != 'Enter';">
                                    @csrf
                                    <input type="hidden" name="content_id" id="content_id">
                                    <div class="form-group">
                                        <label for="section" class="col-form-label">Section</label>
                                        <input value="{{old('section')}}" disabled type="text" name="section"
                                            id="section" class="form-control">
                                    </div>
                                    <div class="form-group row">
                                        <label for="Name" class="col-form-label col-lg-12" id="previous_content_label">Previous Content</label>
                                        <div class="col-lg-12 text-center">
                                            <img class="form-control" id="previous_content" alt="previous-image">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="content" class="col-form-label">New Content</label>
                                        <input type="file" class="form-control" name="content" id="content">
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                <button type="button" id="saveBtn" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    $('body').on('click', '#editContent', function() {
        var content_id = $(this).data("id");
        $.get("{{ route('master.home') }}" + '/' + content_id + '/edit', function(data) {
            $('#contentForm').trigger("reset");
            $('#contentModal').modal("show");
            $('#content_id').val(data.id);
            $('#section').val(data.section);
            $('#previous_content_label').html("Previous Content");
            $('#previous_content').attr("src", data.image_link);
            console.log(data);
        })
    })
    $('body').on('change', '#content', function() {
        var content = $(this).get(0).files[0];
        if (content) {
            var reader = new FileReader();
            reader.onload = function() {
                console.log(reader.result);
                $('#previous_content').attr("src", reader.result);
                $('#previous_content_label').html("New Content");
                $('#previous_content').attr("style", "height:235px; width:auto;");
            }
            reader.readAsDataURL(content);
        }
    })
    $('#saveBtn').click(function(e) {
        e.preventDefault();
        $(this).html('Saving').attr('disabled', true);

        $.ajax({
            data: $('#contentForm').serialize(),
            url: "{{ route('course.store') }}",
            type: "POST",
            dataType: 'JSON',
            success: function(data) {
                $('#saveBtn').html('Save Changes').attr('disabled', false);
                $('#courseForm').trigger("reset");
                $('#courseModal').modal('hide');
                table.draw();
                console.log(data);
            },
            error: function(data) {
                console.log('Error:', data);
                $('#saveBtn').html('Save Changes').attr('disabled', false);
            }
        })
    })
})
</script>
@endsection