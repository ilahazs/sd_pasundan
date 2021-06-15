@extends('layouts.app')

@section('title', 'Profile')

@section('head')
<link href="{{asset('css/plugins/dataTables/datatables.min.css')}}" rel="stylesheet">
@endsection

@section('heading')
<h2>Profile</h2>
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{url('/')}}">Home</a>
    </li>
    <li class="breadcrumb-item">
        <strong>Profile</strong>
    </li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-md-5">
        <div class="ibox">
            <div class="ibox-title">
                <strong>My Profile</strong>
            </div>
            <div>
                <div class="ibox-content no-padding border-left-right">
                    <img src="{{asset('/img/profile-image/'.$user->profile_image)}}" alt="photo-profile"
                        class="img-fluid">
                </div>
                <div class="ibox-content profile-content">
                    <h4><strong>{!! $user->name !!}</strong></h4>
                    <table class="table m-b-xs">
                        <tbody>
                            <tr>
                                <td>
                                    <strong>Nomer Telepon:</strong><br>{!! $user->phone !!}
                                </td>
                                <td>
                                    <strong>Jenis Kelamin :</strong><br>
                                    @if($user->gender == 'p')
                                    Perempuan
                                    @else
                                    Laki - laki
                                    @endif
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    <strong>Nomor Induk :</strong><br>
                                    {!! $user->nis !!}
                                </td>
                                <td>
                                    <strong>Nomor Induk Nasional:</strong><br>
                                    {!! $user->nisn !!}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Kelas :</strong><br>
                                    {!! $class->class_grade !!}
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-sm btn-danger" id="editPassword"
                                        data-id="{{$user->user_id}}">Ubah Password</a>
                                </td>
                            </tr>
                            <tr>
                                <th style="text-align: center !important;" colspan="2">
                                    Login Account
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Email: </strong><br>{!! auth()->user()->email !!}
                                </td>
                                <td>
                                    <strong>Role: </strong><br>{!! ucfirst(auth()->user()->role) !!}
                                </td>
                            </tr>
                            <tr>
                                <th style="text-align: center !important;" colspan="2">

                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal inmodal" id="passwordModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content animated bounceInRight">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span
                                        aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h5 class="modal-title">Ubah Password</h5>
                            </div>
                            <div class="modal-body">
                                <form id="passwordForm" name="passwordForm" onkeydown="return event.key != 'Enter';">
                                    @csrf
                                    <div class="form-group" id="old_password_group">
                                        <label class="col-form-label">Old Password</label>
                                        <input type="password" name="old_password" id="old_password"
                                            value="{{old('old_password')}}" class="form-control" required>
                                    </div>
                                    <div class="form-group" id="new_password_group">
                                        <label class="col-form-label">New Password</label>
                                        <input type="password" name="new_password" id="new_password"
                                            value="{{old('new_password')}}" class="form-control" required>
                                    </div>
                                    <div class="form-group" id="confirm_password_group">
                                        <label class="col-form-label">Confirm Password</label>
                                        <input type="password" name="confirm_password" id="confirm_password"
                                            value="{{old('confirm_password')}}" class="form-control" required>
                                    </div>
                                    <div class="alert alert-danger" id="alert-danger">
                                        
                                    </div>
                                    <div class="alert alert-success" id="alert-success">
                                        
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
    <div class="col-md-7">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Jadwal Pelajaran</h5>
                <div class="ibox-tools mt-1">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
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
                            </tr>
                        </thead>
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
<script>
$(function() {
    var student_id = '{{$user->user_id}}';
    var tableCourseSchedule = $('.dataTables-schedule').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('getSchedule') }}" + "?class_id=2",
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
        ]
    })

    $('#editPassword').click(function() {
        $('#passwordForm').trigger("reset");
        $('#alert-success').hide();
        $('#alert-danger').hide();
        $('#old_password_group').removeClass('has-error');
        $('#new_password_group').removeClass('has-error');
        $('#confirm_password_group').removeClass('has-error');
        $('#passwordModal').modal("show");
    })

    $('#saveBtn').click(function(e) {
        e.preventDefault();
        $(this).html('Saving').attr('disabled', true);
        if ($('#new_password').val() == $('#confirm_password').val()) {
            $.ajax({
                data: $('#passwordForm').serialize(),
                url: "{{ route('myProfile') }}" + '/' + student_id + '/storePassword',
                type: "POST",
                dataType: 'JSON',
                success: function(data) {
                    $('#saveBtn').html('Save Changes').attr('disabled', false);
                    if (data.success) {
                        $('#passwordForm').trigger("reset");
                        $('#alert-danger').hide();
                        $('#alert-success').show();
                        $('#alert-success').html(data.success);
                        $('#old_password_group').removeClass('has-error');
                        $('#new_password_group').removeClass('has-error');
                        $('#confirm_password_group').removeClass('has-error');
                    }
                    if (data.error) {
                        $('#old_password_group').addClass('has-error');
                        $('#alert-danger').show();
                        $('#alert-danger').html(data.error);
                    }
                },
                error: function(data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Save Changes').attr('disabled', false);
                }
            })
        } else {
            $('#alert-danger').show();
            $('#alert-danger').html("Kedua password tidak sama");
            $('#saveBtn').html('Save Changes').attr('disabled', false);
            $('#new_password_group').addClass('has-error');
            $('#confirm_password_group').addClass('has-error');
        }
    })
})
</script>
@endsection