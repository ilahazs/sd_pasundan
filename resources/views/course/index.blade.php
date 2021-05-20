@extends('layouts.app')
@section('title', 'Manage Mata Pelajaran')

@section('head')
<link href="{{asset('css/plugins/dataTables/datatables.min.css')}}" rel="stylesheet">
@endsection

@section('heading')
<h2>Mata Pelajaran</h2>
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{url('/')}}">Home</a>
    </li>
    <li class="breadcrumb-item">
        <strong>Table Mata Pelajaran</strong>
    </li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Table Mata Pelajaran</h5>
                <div class="ibox-tools mb-10">
                    <a href="javascript:void(0)" id="createNewCourse" class="mr-4 btn btn-primary btn-sm">
                        + Mata Pelajaran
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                            <tr>
                                <th class="dataTables_empty">Kode Mata Pelajaran</th>
                                <th class="dataTables_empty">Nama Mata Pelajaran</th>
                                <th class="dataTables_empty">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <!-- Modal -->
                <div class="modal inmodal" id="courseModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content animated bounceInRight">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span
                                        aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h5 class="modal-title">Tambah Mata Pelajaran</h5>
                            </div>
                            <div class="modal-body">
                                <form id="courseForm" name="courseForm" onkeydown="return event.key != 'Enter';">
                                    @csrf
                                    <input type="hidden" name="course_id" id="course_id">
                                    <div class="form-group course_code_group">
                                        <label for="Code" class="col-form-label">Kode Pelajaran</label>
                                        <input value="{{old('course_code')}}" required type="text" name="course_code" id="course_code"
                                            class="form-control">
                                        @error('course_code')
                                        <li class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </li>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="Name" class="col-form-label">Nama Pelajaran</label>
                                        <input value="{{old('name')}}" required type="text" name="course_name" id="course_name"
                                            class="form-control">
                                        @error('course_name')
                                        <li class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </li>
                                        @enderror
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
<script src="{{asset('js/plugins/dataTables/datatables.min.js')}}"></script>
<script src="{{asset('js/plugins/dataTables/dataTables.bootstrap4.min.js')}}"></script>
<script>
$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var table = $('.dataTables-example').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('course') }}",
        columns: [{
                data: 'course_code',
                name: 'course_code'
            },
            {
                data: 'course_name',
                name: 'course_name'
            },
            {
                data: 'action',
                name: 'action',
                className: 'dataTables_empty',
                orderable: false,
                searchable: false
            }
        ]
    });
    $('#createNewCourse').click(function() {
        $('.course_code_group').hide(true);
        $('#courseModal').modal('show');
        $('#courseForm').trigger("reset");
    });

    $('body').on('click', '.editCourse', function () {
        var course_id = $(this).data('id');
        $.get("{{ route('course') }}" + '/' + course_id + '/edit', function (data) {
            $('#courseForm').trigger("reset");
            $('.course_code_group').show(true);
            $('#courseModal').modal("show");
            $('#course_id').val(data.id);
            $('#course_name').val(data.course_name);
            $('#course_code').val(data.course_code);
            console.log(data);
        })
    })
    
    $('#saveBtn').click(function(e) {
        e.preventDefault();
        $(this).html('Saving').attr('disabled', true);

        $.ajax({
            data: $('#courseForm').serialize(),
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