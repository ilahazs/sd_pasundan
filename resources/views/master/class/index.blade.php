@extends('layouts.app')
@section('title', 'Master Kelas')

@section('head')
   <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
   <link href="{{ asset('css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">
   <link href="{{ asset('css/plugins/datapicker/datepicker3.css') }}" rel="stylesheet">

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
      @include('master.class.variable.index')
   </div>
@endsection

@section('scripts')
   <script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>
   <script src="{{ asset('js/plugins/dataTables/dataTables.bootstrap4.min.js') }}"></script>
   <script src="{{ asset('js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.4/dist/sweetalert2.all.min.js"></script>
   <script>
      $(function() {
         $.ajaxSetup({
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
         })
         // js grade
         var tableGrade = $('.dataTables-grade').DataTable({
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

         $('#refreshTableGrade').click(function() {
            tableGrade.draw();
         })

         $('#createNewGrade').click(function() {
            $('#gradeModal').modal('show');
            $('#gradeForm').trigger("reset");
         });

         $('body').on('click', '.editGrade', function() {
            var grade_id = $(this).data("id");
            $.get("{{ route('master.grade') }}" + '/' + grade_id + '/edit', function(data) {
               $('#gradeForm').trigger("reset");
               $('#gradeModal').modal("show");
               $('#grade_id').val(data.id);
               $('#grade_name').val(data.grade);
            })
         })

         $('#saveGrade').click(function(e) {
            e.preventDefault();
            $(this).html('Saving').attr('disabled', true);

            $.ajax({
               data: $('#gradeForm').serialize(),
               url: "{{ route('master.grade.store') }}",
               type: "POST",
               dataType: 'JSON',
               success: function(data) {
                  $('#saveGrade').html('Save Changes').attr('disabled', false);
                  $('#gradeForm').trigger("reset");
                  $('#gradeModal').modal('hide');
                  tableGrade.draw();
               },
               error: function(data) {
                  console.log('Error:', data);
                  $('#saveGrade').html('Save Changes').attr('disabled', false);
               }
            })
         })

         $('body').on('click', '.deleteGrade', function() {
            var grade_id = $(this).data("id");
            $(this).hide();
            Swal.fire({
               title: 'Hapus tingkatan kelas?',
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
                     url: "{{ route('master.grade') }}" + '/' + grade_id + '/delete',
                     success: function(data) {
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
                        tableGrade.draw();
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

         // js variable
         var tableVariable = $('.dataTables-variable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('master.variable') }}",
            columns: [{
                  data: 'variable',
                  name: 'variable'
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

         $('#refreshTableVariable').click(function() {
            tableVariable.draw();
         })

         $('#createNewVariable').click(function() {
            $('#variableModal').modal('show');
            $('#variableForm').trigger("reset");
         });

         $('body').on('click', '.editVariable', function() {
            var grade_id = $(this).data("id");
            $.get("{{ route('master.variable') }}" + '/' + grade_id + '/edit', function(data) {
               $('#variableForm').trigger("reset");
               $('#variableModal').modal("show");
               $('#variable_id').val(data.id);
               $('#variable_name').val(data.variable);
            })
         })

         $('#saveVariable').click(function(e) {
            e.preventDefault();
            $(this).html('Saving').attr('disabled', true);

            $.ajax({
               data: $('#variableForm').serialize(),
               url: "{{ route('master.variable.store') }}",
               type: "POST",
               dataType: 'JSON',
               success: function(data) {
                  $('#saveVariable').html('Save Changes').attr('disabled', false);
                  $('#variableForm').trigger("reset");
                  $('#variableModal').modal('hide');
                  tableVariable.draw();
               },
               error: function(data) {
                  console.log('Error:', data);
                  $('#saveVariable').html('Save Changes').attr('disabled', false);
               }
            })
         })
         $('body').on('click', '.deleteVariable', function() {
            var variable_id = $(this).data("id");
            $(this).hide();
            Swal.fire({
               title: 'Hapus variabel kelas?',
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
                     url: "{{ route('master.variable') }}" + '/' + variable_id +
                        '/delete',
                     success: function(data) {
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
                        tableVariable.draw();
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
      })
   </script>
@endsection
