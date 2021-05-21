@extends('layouts.app')
@section('title', 'Master Kelas')

@section('head')
<link href="{{asset('css/plugins/dataTables/datatables.min.css')}}" rel="stylesheet">
<link href="{{asset('css/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">
@endsection

@section('heading')
<h2>Master Class</h2>
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('homepage') }}">Home</a>
    </li>
    <li class="breadcrumb-item">
        <strong>Master Data Kelas</strong>
    </li>
</ol>
@endsection

@section('content')
<div class="row">
    @include('master.class.grade.index')
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
    var table = $('.dataTables-example').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('master.grade') }}",
        columns: [{
                data: 'grade',
                name: 'grade'
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
    $('#createNewGrade').click(function() {
        $('#gradeModal').modal('show');
        $('#gradeForm').trigger("reset");
    });

    $('body').on('click', '.editGrade', function () {
        var grade_id = $(this).data("id");
        $.get("{{ route('master.grade') }}" + '/' + grade_id + '/edit', function (data) {
            $('#gradeForm').trigger("reset");
            $('#gradeModal').modal("show");
            $('#grade_id').val(data.id);
            $('#grade_name').val(data.grade);
        })
    })
    
    $('#saveBtn').click(function(e) {
        e.preventDefault();
        $(this).html('Saving').attr('disabled', true);

        $.ajax({
            data: $('#gradeForm').serialize(),
            url: "{{ route('master.grade.store') }}",
            type: "POST",
            dataType: 'JSON',
            success: function(data) {
                $('#saveBtn').html('Save Changes').attr('disabled', false);
                $('#gradeForm').trigger("reset");
                $('#gradeModal').modal('hide');
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