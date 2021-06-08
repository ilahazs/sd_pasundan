@extends('layouts.app')

@section('title', 'Manage Siswa')

@section('head')
<link href="{{asset('css/plugins/dataTables/datatables.min.css')}}" rel="stylesheet">
<link href="{{asset('css/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">
<link href="{{asset('css/plugins/select2/select2.min.css')}}" rel="stylesheet">
<link href="{{asset('css/plugins/select2/select2-bootstrap4.min.css')}}" rel="stylesheet">
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
                            <a href="javascript:void(0)" class="dropdown-item">Tambah Siswa</a>
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
$(document).ready(function() {
    // var tableStudent = $('.dataTables-student').DataTable();
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
    $(document).on('click', '.deleteStudent', function(e) {
        var student_id = $(this).data("id");
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
                    url: "{{ route('student') }}" + '/' + student_id + '/delete',
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