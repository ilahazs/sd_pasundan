<!-- modal -->
<div class="modal inmodal" id="variableModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <h5 class="modal-title">Tambah Variabel</h5>
            </div>
            <div class="modal-body">
                <form id="variableForm" name="variableForm" onkeydown="return event.key != 'Enter';">
                    @csrf
                    <input type="hidden" name="variable_id" id="variable_id">
                    <div class="form-group">
                        <label for="Variable" class="col-form-label">Variable</label>
                        <input value="{{old('variable_name')}}" required type="text" name="variable_name" id="variable_name"
                            class="form-control">
                        @error('variable_name')
                        <li class="text-danger">
                            <strong>{{ $message }}</strong>
                        </li>
                        @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <button type="button" id="saveVariable" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- content -->
<div class="col-lg-12">
    <div class="ibox">
        <div class="ibox-title">
            <h5>Variabel Kelas</h5>
            <div class="ibox-tools mt-1">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>
                <a id="refreshTableVariable" data-toggle="tooltip" data-placement="top" title="View">
                    <i class="fa fa-refresh"></i>
                </a>
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-plus"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li>
                        <a href="javascript:void(0)" id="createNewVariable" class="dropdown-item">Tambah Variabel</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="ibox-content">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover dataTables-variable">
                    <thead>
                        <tr>
                            <th>Variabel Kelas</th>
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