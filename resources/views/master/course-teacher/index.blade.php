@extends('layouts.app')
@section('title', 'Master Guru Mapel')
@section('head')
<link href="{{asset('css/plugins/dataTables/datatables.min.css')}}" rel="stylesheet">
<link href="{{asset('css/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">
<link href="{{asset('css/plugins/datapicker/datepicker3.css')}}" rel="stylesheet">
@endsection

@section('heading')
<h2>Master Guru Mata Pelajaran</h2>
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('homepage') }}">Home</a>
    </li>
    <li class="breadcrumb-item">
        <strong>Master Data Guru Mata Pelajaran</strong>
    </li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Table Guru Mata Pelajaran</h5>
                <div class="ibox-tools mt-1">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-plus"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li>
                            <a href="javascript:void(0)" id="createNewCT" class="dropdown-item">Tambah Guru</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-teacher">
                        <thead>
                            <tr>
                                <th>Guru</th>
                                <th>Pelajaran</th>
                                <th>Tahun ajaran</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <!-- Modal -->
                <div class="modal inmodal" id="ctModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content animated bounceInRight">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span
                                        aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h5 class="modal-title">Tambah Mata Pelajaran</h5>
                            </div>
                            <div class="modal-body">
                                <form id="ctForm" name="ctForm" onkeydown="return event.key != 'Enter';">
                                    @csrf
                                    <input type="hidden" name="ct_id" id="ct_id">
                                    <div class="form-group">
                                        <label for="teacher_id" class="col-form-label">Guru</label>
                                        <select name="teacher_id" id="teacher_id" class="form-control">
                                            <option value="" selected disabled>- PILIH GURU -</option>
                                            @foreach($teacher as $row)
                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="course_id" class="col-form-label">Mata Pelajaran</label>
                                        <select name="course_id" id="course_id" class="form-control">
                                            <option value="" selected disabled>- PILIH MATA PELAJARAN -</option>
                                            @foreach($course as $row)
                                            <option value="{{$row->id}}">{{$row->course_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="year_id" class="col-form-label">Tahun Ajaran</label>
                                        <select name="year_id" id="year_id" class="form-control">
                                            <option value="" selected disabled>- PILIH TAHUN -</option>
                                            @foreach($year as $row)
                                            <option value="{{$row->id}}">{{$row->start_year}} / {{$row->end_year}}
                                            </option>
                                            @endforeach
                                        </select>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.4/dist/sweetalert2.all.min.js"></script>
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
var table = $('.dataTables-teacher').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('course-teacher.table') }}",
    columns: [{
            data: 'teacher_name',
            name: 'teacher_name'
        },
        {
            data: 'course_name',
            name: 'course_name'
        },
        {
            data: 'school_year',
            name: 'school_year'
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
$('#createNewCT').click(function() {
    $('#ctModal').modal('show');
    $('#ctForm').trigger("reset");
});

$('body').on('click', '.editCourseTeacher', function() {
    var class_id = $(this).data("id");
    $.get("{{ route('course-teacher') }}" + '/' + class_id + '/edit', function(data) {
        $('#ctForm').trigger("reset");
        $('#ctModal').modal("show");
        $('#ct_id').val(data.id);
        $('#teacher_id').val(data.teacher_id).trigger('change');
        $('#course_id').val(data.course_id).trigger('change');
        $('#year_id').val(data.year_id).trigger('change');
    })
})

$('#saveBtn').click(function(e) {
    e.preventDefault();
    $(this).html('Saving').attr('disabled', true);

    $.ajax({
        data: $('#ctForm').serialize(),
        url: "{{ route('course-teacher.store') }}",
        type: "POST",
        dataType: 'JSON',
        success: function(data) {
            $('#saveBtn').html('Save Changes').attr('disabled', false);
            $('#ctForm').trigger("reset");
            $('#ctModal').modal('hide');
            table.draw();
        },
        error: function(data) {
            console.log('Error:', data);
            $('#saveBtn').html('Save Changes').attr('disabled', false);
        }
    })
})
$('body').on('click', '.deleteCourseTeacher', function() {
    var class_id = $(this).data("id");
    Swal.fire({
        title: 'Hapus guru mata pelajaran?',
        text: "Anda tidak akan dapat mengembalikan ini!",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#ed5565',
        cancelButtonColor: '#343a40',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value == true) {
            $.ajax({
                type: "GET",
                url: "{{ route('course-teacher') }}" + '/' + class_id + '/delete',
                success: function(data) {
                    if (data.error) {
                        Swal.fire(
                            'Error!',
                            data.error,
                            'error'
                        );
                    }
                    Swal.fire(
                        'Deleted!',
                        data.success,
                        'success'
                    );
                    table.draw();
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        }
    })
})
</script>
@endsection