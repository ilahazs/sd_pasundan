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