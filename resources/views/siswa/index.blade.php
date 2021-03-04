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
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Table Siswa</h5>
                <div class="ibox-tools mb-10">
                    <a href="{{url('admin/student/create')}}" class="mr-4 btn btn-primary btn-sm">
                        Add Siswa
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-striped dataTables">
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
                            @foreach($siswa as $row)
                            <tr>
                                <td>{{$row->name}}</td>
                                <!-- <td></td> -->
                                <td>{{$row->nis}}</td>
                                <td>{{$row->nisn}}</td>
                                <td class="dataTables_empty">
                                    <div class="btn-group">
                                        <a href="student/{{$row->id}}/show" class="btn-dark btn btn-sm mr-2" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye"></i></a>
                                        <a href="student/{{$row->id}}/edit" class="btn-warning btn btn-sm mr-2" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                        <a href="student/{{$row->id}}/delete" class="edit btn btn-danger btn-sm delete-btn mr-2" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
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
        $(document).on('click', '.delete-btn', function (e) {
            e.preventDefault();
            const url = $(this).attr('href');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ed5565',
                cancelButtonColor: '#343a40',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                    );
                    window.location.href = url;
                }
            })
        });
    </script>

    <!-- <script>
        $(document).ready(function () {
            var table = $('.dataTables').DataTable({
                processing:true,
                serverSide:true,
                destroy:true,
                ajax:{
                    headers: {
                        'X-CSRF-TOKEN': '{{csrf_token()}}'
                    },
                    url: '{!! route('tablestudent') !!}',
                    type: 'POST',
                    data: [],
                },
                columns: [
                    {data: 'name', name:'name'},
                    {data: 'phone', name:'phone'},
                    {data: 'nis', name:'nis'},
                    {data: 'nisn', name:'nisn'},
                    {data: 'id'}
                ],
                pageLenght:10,
                responsive:true,
                autoWidht:false,
                dom:'<"html5buttons"B>lTfgitp',
                buttons:[],
            })
        })
    </script> -->
@endsection