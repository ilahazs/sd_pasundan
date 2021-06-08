@extends('layouts.app')

@section('title', 'Manage Siswa')

@section('head')
<link href="{{asset('css/plugins/dataTables/datatables.min.css')}}" rel="stylesheet">
<link href="{{asset('css/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{asset('css/plugins/select2/select2.min.css')}}">
@endsection

@section('heading')
<h2>Siswa</h2>
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{url('/')}}">Home</a>
    </li>
    <li class="breadcrumb-item">
        <strong>Table Siswa</strong>
    </li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Table Siswa</h5>
                <div class="ibox-tools mt-1">
                    <a id="refreshTableStudent" data-toggle="tooltip" data-placement="top" title="View">
                        <i class="fa fa-refresh"></i>
                    </a>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-plus"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li>
                            <a href="javascript:void(0)" id="createNewStudent" class="dropdown-item">Tambah Siswa</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-student"
                        data-id="{{$class->id}}">
                        <thead>
                            <tr>
                                <th class="dataTables_empty">Nama Siswa</th>
                                <!-- <th class="dataTables_empty">Kelas</th> -->
                                <th class="dataTables_empty">NIS</th>
                                <th class="dataTables_empty">NISN</th>
                                <th class="dataTables_empty">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <!-- Modal -->
                <div class="modal inmodal" id="scModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content animated bounceInRight">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span
                                        aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h5 class="modal-title">Tambah Siswa</h5>
                            </div>
                            <div class="modal-body">
                                <form id="scForm" name="scForm" onkeydown="return event.key != 'Enter';">
                                    @csrf
                                    <input type="hidden" name="sc_id" id="sc_id">
                                    <div class="form-group">
                                        <label for="student_id" class="col-form-label">Guru</label>
                                        <form>
                                            <select name="student_id" id="student_id" class="form-control"
                                                data-toggle="select">
                                                <option value="" selected disabled>- PILIH SISWA -</option>
                                                @foreach($student as $row)
                                                <option value="{{$row->id}}">{{$row->name}}</option>
                                                @endforeach
                                            </select>
                                        </form>
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
<script src="{{asset('js/plugins/select2/select2.full.min.js')}}"></script>\
<script>
$(document).ready(function() {
    var class_id = $('.dataTables-student').data("id");
    var tableStudent = $('.dataTables-student').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('classroom') }}" + '/' + class_id + '/tablestudent',
        },
        columns: [{
                data: 'student_name',
                name: 'student_name'
            },
            {
                data: 'student_nis',
                name: 'student_nis'
            },
            {
                data: 'student_nisn',
                name: 'student_nisn'
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

    $('#refreshTableStudent').click(function() {
        tableStudent.draw();
    })
    
    $('#createNewStudent').click(function() {
        $('#scForm').trigger("reset");
        $('#scModal').modal('show');
        $('#student_id').select2({
            dropdownParent: $('#scModal')
        });
    })

    $('#saveBtn').click(function(e) {
        e.preventDefault();
        $(this).html('Saving').attr('disabled', true);

        $.ajax({
            data: $('#scForm').serialize(),
            url: "{{ route('classroom') }}" + '/' + class_id + '/addStudent',
            type: "POST",
            dataType: 'JSON',
            success: function(data) {
                $('#saveBtn').html('Save Changes').attr('disabled', false);
                $('#scForm').trigger("reset");
                $('#scModal').modal('hide');
                tableStudent.draw();
            },
            error: function(data) {
                console.log('Error:', data);
                $('#saveBtn').html('Save Changes').attr('disabled', false);
            }
        })
    })

    $(document).on('click', '.deleteStudent', function(e) {
        var class_id = $(this).data("id");
        $(this).hide();
        Swal.fire({
            title: 'Hapus siswa?',
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
                    url: "{{ route('classroom') }}" + '/' + class_id + '/removeStudent',
                    success: function(data) {
                        // console.log(data);
                        if (data.error) {
                            Swal.fire(
                                'Error!',
                                data.error,
                                'error'
                            );
                            $(this).show();
                        } else {
                            Swal.fire(
                                'Deleted!',
                                data.success,
                                'success'
                            );
                        }
                        tableStudent.draw();
                    },
                    error: function(data) {
                        console.log('Error:', data);
                        $(this).show();
                    }
                });
            } else {
                $(this).show();
            }
        })
    });
})
</script>
@endsection