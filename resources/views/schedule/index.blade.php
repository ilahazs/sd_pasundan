@extends('layouts.app')
@section('title', 'Manage Jadwal Pelajaran')

@section('head')
<link href="{{asset('css/plugins/dataTables/datatables.min.css')}}" rel="stylesheet">
<link href="{{asset('css/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">
@endsection

@section('heading')
<h2>Jadwal Pelajaran</h2>
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{url('/')}}">Home</a>
    </li>
    <li class="breadcrumb-item">
        <strong>Jadwal Pelajaran</strong>
    </li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Table Jadwal Pelajaran</h5>
                <div class="ibox-tools mt-1">
                    <a id="refreshTableCourseSchedule" data-toggle="tooltip" data-placement="top" title="View">
                        <i class="fa fa-refresh"></i>
                    </a>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-plus"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li>
                            <a href="javascript:void(0)" id="createNewCourseSchedule" class="dropdown-item">Tambah
                                Jadwal Pelajaran</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-schedule">
                        <thead>
                            <tr>
                                <th class="dataTables_empty">Hari</th>
                                <th class="dataTables_empty">Kelas</th>
                                <th class="dataTables_empty">Mata Pelajaran</th>
                                <th class="dataTables_empty">Guru</th>
                                <th class="dataTables_empty">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="modal inmodal" id="courseScheduleModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content animated bounceInRight">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span
                                        aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h5 class="modal-title">Tambah Jadwal Pelajaran</h5>
                            </div>
                            <div class="modal-body">
                                <form id="courseScheduleForm" name="courseScheduleForm"
                                    onkeydown="return event.key != 'Enter';">
                                    @csrf
                                    <input type="hidden" name="cs_id" id="cs_id">
                                    <div class="form-group">
                                        <label for="class_id" class="col-form-label">Kelas</label>
                                        <select name="class_id" id="class_id" class="form-control">
                                            <option value="" selected disabled>- PILIH KELAS -</option>
                                            @foreach($classroom as $row)
                                            <option value="{{$row->id}}">{{$row->grade}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="c_teacher_id" class="col-form-label">Kelas</label>
                                        <select name="c_teacher_id" id="c_teacher_id" class="form-control">
                                            <option value="" selected disabled>- PILIH PELAJARAN -</option>
                                            @foreach($course as $row)
                                            <option value="{{$row->id}}">{{$row->course_name}} - {{$row->teacher_name}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="day_id" class="col-form-label">Hari</label>
                                        <select name="day_id" id="day_id" class="form-control">
                                            <option value="" selected disabled>- PILIH HARI -</option>
                                            @foreach($day as $row)
                                            <option value="{{$row->id}}">{{$row->name}}</option>
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
$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    var tableCourseSchedule = $('.dataTables-schedule').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('schedule') }}",
        columns: [{
                data: 'day_name',
                name: 'day_id'
            },
            {
                data: 'class_name',
                name: 'class_name'
            },
            {
                data: 'course_name',
                name: 'course_name'
            },
            {
                data: 'teacher_name',
                name: 'teacher_name'
            },
            {
                data: 'action',
                name: 'action',
                className: 'dataTables_empty',
                orderable: false,
                searchable: false
            }
        ]
    })

    $('#refreshTableCourseSchedule').click(function() {
        tableCourseSchedule.draw();
    })

    $('#createNewCourseSchedule').click(function() {
        $('#courseScheduleForm').trigger("reset");
        $('#courseScheduleModal').modal('show');
    })
    $('body').on('click', '.editCourseSchedule', function() {
        var schedule_id = $(this).data("id");
        $.get("{{ route('schedule') }}" + '/' + schedule_id + '/edit', function(data) {
            $('#courseScheduleForm').trigger("reset");
            $('#courseScheduleModal').modal("show");
            $('#cs_id').val(data.id);
            $('#class_id').val(data.class_id).trigger('change');
            $('#c_teacher_id').val(data.c_teacher_id).trigger('change');
            $('#day_id').val(data.day_id).trigger('change');
        })
    })
    $('#saveBtn').click(function(e) {
        e.preventDefault();
        $(this).html('Saving').attr('disabled', true);

        $.ajax({
            data: $('#courseScheduleForm').serialize(),
            url: "{{ route('schedule.store') }}",
            type: "POST",
            dataType: 'JSON',
            success: function(data) {
                $('#saveBtn').html('Save Changes').attr('disabled', false);
                $('#courseScheduleForm').trigger("reset");
                $('#courseScheduleModal').modal('hide');
                tableCourseSchedule.draw();
                console.log(data);
            },
            error: function(data) {
                console.log('Error:', data);
                $('#saveBtn').html('Save Changes').attr('disabled', false);
            }
        })
    })
    $('body').on('click', '.deleteCourseSchedule', function() {
        var schedule_id = $(this).data("id");
        Swal.fire({
            title: 'Hapus kelas?',
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
                    url: "{{ route('schedule') }}" + '/' + schedule_id + '/delete',
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
                        tableCourseSchedule.draw();
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            }
        })
    })
})
</script>
@endsection