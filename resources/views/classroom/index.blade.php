@extends('layouts.app')
@section('title', 'Kelas')

@section('head')
<link href="{{asset('css/plugins/dataTables/datatables.min.css')}}" rel="stylesheet">
<link href="{{asset('css/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">
<link href="{{asset('css/plugins/datapicker/datepicker3.css')}}" rel="stylesheet">
@endsection

@section('heading')
<h2>Class</h2>
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('homepage') }}">Home</a>
    </li>
    <li class="breadcrumb-item">
        <strong>Manage Kelas</strong>
    </li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Table Kelas</h5>
                <div class="ibox-tools mt-1">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-plus"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li>
                            <a href="javascript:void(0)" id="createNewClass" class="dropdown-item">Tambah Kelas</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-class">
                        <thead>
                            <tr>
                                <th>Kelas</th>
                                <th>Tahun ajaran</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <!-- Modal -->
                <div class="modal inmodal" id="classModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content animated bounceInRight">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span
                                        aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h5 class="modal-title">Tambah Mata Pelajaran</h5>
                            </div>
                            <div class="modal-body">
                                <form id="classForm" name="classForm" onkeydown="return event.key != 'Enter';">
                                    @csrf
                                    <input type="hidden" name="class_id" id="class_id">
                                    <div class="form-group row">
                                        <label for="class_row" class="col-form-label col-lg-12">Kelas</label>
                                        <div class="col-lg-12" id="class_row">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <select name="grade_id" id="grade_id" class="form-control">
                                                        <option value="" selected disabled>- PILIH KELAS -</option>
                                                        @foreach($grade as $row)
                                                        <option value="{{$row->id}}">{{$row->grade}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-6">
                                                    <select name="variable_id" id="variable_id" class="form-control">
                                                        <option value="" selected disabled>- PILIH KELAS -</option>
                                                        @foreach($variable as $row)
                                                        <option value="{{$row->id}}">{{$row->variable}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="course_name" class="col-form-label">Tahun Ajaran</label>
                                        <select name="year_id" id="year_id" class="form-control">
                                            <option value="" selected disabled>- PILIH TAHUN -</option>
                                            @foreach($year as $row)
                                            <option value="{{$row->id}}">{{$row->start_year}} / {{$row->end_year}}
                                            </option>
                                            @endforeach
                                        </select>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.4/dist/sweetalert2.all.min.js"></script>
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
var table = $('.dataTables-class').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('classroom') }}",
    columns: [{
            data: 'grade',
            name: 'grade'
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
$('#createNewClass').click(function() {
    $('#classModal').modal('show');
    $('#classForm').trigger("reset");
});

$('body').on('click', '.editClass', function() {
    var class_id = $(this).data("id");
    $.get("{{ route('classroom') }}" + '/' + class_id + '/edit', function(data) {
        $('#classForm').trigger("reset");
        $('#classModal').modal("show");
        $('#class_id').val(data.id);
        $('#grade_id').val(data.grade_id).trigger('change');
        $('#variable_id').val(data.variable_id).trigger('change');
        $('#year_id').val(data.year_id).trigger('change')
        console.log(data);
    })
})

$('#saveBtn').click(function(e) {
    e.preventDefault();
    $(this).html('Saving').attr('disabled', true);

    $.ajax({
        data: $('#classForm').serialize(),
        url: "{{ route('classroom.store') }}",
        type: "POST",
        dataType: 'JSON',
        success: function(data) {
            $('#saveBtn').html('Save Changes').attr('disabled', false);
            $('#classForm').trigger("reset");
            $('#classModal').modal('hide');
            table.draw();
            console.log(data);
        },
        error: function(data) {
            console.log('Error:', data);
            $('#saveBtn').html('Save Changes').attr('disabled', false);
        }
    })
})
$('body').on('click', '.deleteClass', function() {
    var class_id = $(this).data("id");
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
                url: "{{ route('classroom') }}" + '/' + class_id + '/delete',
                success: function(data) {
                    // console.log(data);
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