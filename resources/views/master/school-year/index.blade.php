@extends('layouts.app')
@section('title', 'Master Tahun Ajaran')

@section('head')
<link href="{{asset('css/plugins/dataTables/datatables.min.css')}}" rel="stylesheet">
<link href="{{asset('css/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">
<link href="{{asset('css/plugins/datapicker/datepicker3.css')}}" rel="stylesheet">
@endsection

@section('heading')
<h2>Master Class</h2>
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('homepage') }}">Home</a>
    </li>
    <li class="breadcrumb-item">
        <strong>Master Data Tahun Ajaran</strong>
    </li>
</ol>
@endsection

@section('content')
<!-- modal -->
<div class="modal inmodal" id="yearModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <h5 class="modal-title">Tambah Tahun Ajaran</h5>
            </div>
            <div class="modal-body">
                <form id="yearForm" name="yearForm" onkeydown="return event.key != 'Enter';">
                    @csrf
                    <input type="hidden" name="year_id" id="year_id">
                    <div class="form-group" id="data_5">
                        <label class="font-normal">Tahun Ajaran</label>
                        <div class="input-daterange input-group" id="datepicker">
                            <input type="text" class="form-control-sm form-control" name="start_year" id="start_year">
                            <span class="input-group-addon">s/d</span>
                            <input type="text" class="form-control-sm form-control" name="end_year" id="end_year">
                        </div>
                        @error('year')
                        <li class="text-danger">
                            <strong>{{ $message }}</strong>
                        </li>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="Aktif" class="col-form-label">Sedang Aktif</label>
                        <div class="switch">
                            <div class="onoffswitch">
                                <input type="checkbox" name="isActive" class="onoffswitch-checkbox" id="isActive">
                                <label class="onoffswitch-label" for="isActive">
                                    <span class="onoffswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <button type="button" id="saveYear" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- content -->
<div class="col-lg-12">
    <div class="ibox">
        <div class="ibox-title">
            <h5>Tahun Ajaran</h5>
            <div class="ibox-tools mt-1">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>
                <a id="refreshTableYear" data-toggle="tooltip" data-placement="top" title="View">
                    <i class="fa fa-refresh"></i>
                </a>
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-plus"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li>
                        <a href="javascript:void(0)" id="createNewYear" class="dropdown-item">Tambah Tahun Ajaran</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="ibox-content">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover dataTables-year">
                    <thead>
                        <tr>
                            <th>Tahun Ajaran</th>
                            <th>Aktif</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

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
<script src="{{asset('js/plugins/datapicker/bootstrap-datepicker.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.4/dist/sweetalert2.all.min.js"></script>
<script>
var tableYear = $('.dataTables-year').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('master.school-year.table') }}",
    columns: [{
            data: 'year',
            name: 'year'
        },
        {
            data: 'is_active',
            name: 'is_active',
            className: 'dataTables_empty',
            orderable: false,
            searchable: false
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

$('#refreshTableYear').click(function() {
    tableYear.draw();
})

$('#createNewYear').click(function() {
    $('#data_5 .input-daterange').datepicker({
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true,
        format: "yyyy",
        viewMode: "years",
        minViewMode: "years"
    });
    $('#yearModal').modal('show');
    $('#yearForm').trigger("reset");
});

$('body').on('click', '.editYear', function() {
    var year_id = $(this).data("id");
    $.get("{{ route('master.school-year') }}" + '/' + year_id + '/edit', function(data) {
        $('#yearForm').trigger("reset");
        $('#yearModal').modal("show");
        $('#year_id').val(data.id);
        $('#start_year').val(data.start_year);
        $('#end_year').val(data.end_year);
        $('#isActive').attr('checked', false);
        if (data.isActive == "1") {
            $('#isActive').attr('checked', true);
        }
    })
})

$('#saveYear').click(function(e) {
    e.preventDefault();
    $(this).html('Saving').attr('disabled', true);

    $.ajax({
        data: $('#yearForm').serialize(),
        url: "{{ route('master.school-year.store') }}",
        type: "POST",
        dataType: 'JSON',
        success: function(data) {
            $('#saveYear').html('Save Changes').attr('disabled', false);
            $('#yearForm').trigger("reset");
            $('#yearModal').modal('hide');
            tableYear.draw();
        },
        error: function(data) {
            console.log('Error:', data);
            $('#saveYear').html('Save Changes').attr('disabled', false);
        }
    })
})
$('body').on('click', '.deleteYear', function() {
    var year_id = $(this).data("id");
    $(this).hide();
    Swal.fire({
        title: 'Hapus tahun ajaran?',
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
                url: "{{ route('master.school-year') }}" + '/' + year_id +
                    '/delete',
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
                    tableYear.draw();
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
})
</script>
@endsection