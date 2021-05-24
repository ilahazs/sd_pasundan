<!-- modal -->
<div class="modal inmodal" id="gradeModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <h5 class="modal-title">Tambah Tingkatan</h5>
            </div>
            <div class="modal-body">
                <form id="gradeForm" name="gradeForm" onkeydown="return event.key != 'Enter';">
                    @csrf
                    <input type="hidden" name="grade_id" id="grade_id">
                    <div class="form-group">
                        <label for="Grade" class="col-form-label">Tingkatan</label>
                        <input value="{{old('grade_name')}}" required type="text" name="grade_name" id="grade_name"
                            class="form-control">
                        @error('grade_name')
                        <li class="text-danger">
                            <strong>{{ $message }}</strong>
                        </li>
                        @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <button type="button" id="saveGrade" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- content -->
<div class="col-lg-12">
    <div class="ibox">
        <div class="ibox-title">
            <h5>Tingkatan Kelas</h5>
            <div class="ibox-tools mt-1">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-plus"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li>
                        <a href="javascript:void(0)" id="createNewGrade" class="dropdown-item">Tambah Tingkatan</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="ibox-content">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover dataTables-grade">
                    <thead>
                        <tr>
                            <th>Grade</th>
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