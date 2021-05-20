@extends('layouts.app')

@section('title', 'Edit Guru')

@section('head')

@endsection

@section('heading')
<h2>Ubah Data Guru</h2>
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{url('/')}}">Home</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{url('/student')}}">Table Guru</a>
    </li>
    <li class="breadcrumb-item">
        <strong>Edit Guru</strong>
    </li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title">
                <h5>Data Guru</h5>
            </div>
            <div class="ibox-content">
                <form action="{{url('admin/teacher/'.$teacher->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="Name" class="col-lg-2 col-form-label">Name</label>
                        <div class="col-lg-10">
                            <input value="{{old('name', $teacher->name)}}" required type="text" name="name" id="name"
                                class="form-control">
                            @error('name')
                            <li class="text-danger">
                                <strong>{{ $message }}</strong>
                            </li>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Nis" class="col-lg-2 col-form-label">NIP</label>
                        <div class="col-lg-10">
                            <input value="{{old('nip', $teacher->nip)}}" required type="text" name="nip" id="nip"
                                class="form-control">
                            @error('nip')
                            <li class="text-danger">
                                <strong>{{ $message }}</strong>
                            </li>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Jenis Kelamin" class="col-lg-2 col-form-label">Jenis Kelamin</label>
                        <div class="col-lg-5">
                            <select required name="gender" id="gender" class="form-control">
                                <option value="">- PILIH JENIS KELAMIN -</option>
                                <option {{ old('gender', $teacher->gender) == 'l' ? "selected" : "" }} value="l">
                                    Laki-laki</option>
                                <option {{ old('gender', $teacher->gender) == 'p' ? "selected" : "" }} value="p">
                                    Perempuan</option>
                            </select>
                            @error('gender')
                            <li class="text-danger">
                                <strong>{{ $message }}</strong>
                            </li>
                            @enderror
                        </div>
                        <label for="Phone" class="col-lg-1 col-form-label">Phone</label>
                        <div class="col-lg-4">
                            <div class="input-group m-b">
                                <div class="input-group-prepend">
                                    <span class="input-group-addon">+62</span>
                                </div>
                                <input value="{{old('phone', $teacher->phone)}}" required type="text" name="phone"
                                    id="phone" class="form-control">
                            </div>
                            @error('phone')
                            <li class="text-danger">
                                <strong>{{ $message }}</strong>
                            </li>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Item" class="col-lg-2 col-form-label">
                            Photo Profile <br><span class="small text-warning">(Photo harus berskala 3:4)</span>
                        </label>
                        <div class="col-lg-10 item-content">
                            <label class="label-image">
                                <img id="preview-image" class="m-xs img-md"
                                src="{{asset('img/profile-image/'.$teacher->profile_image)}}">
                                <div class="btn-group-sm text-center">
                                    <label class="btn btn-primary" id="image-btn">
                                        <i class="fa fa-paperclip" id="image-btn"></i>
                                        <input value="{{old('profile_image', $teacher->profile_image)}}" type="file"
                                        onchange="changePreviewImage()" id="input-image" name="profile_image" hidden
                                        accept=".png, .jpg, .jpeg">
                                    </label>
                                </div>
                            </label>
                            @error('profile_image')
                            <li class="text-danger">
                                <strong>{{ $message }}</strong>
                            </li>
                            @enderror
                        </div>
                    </div>
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Akun Guru</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="form-group row">
                                <label for="Email" class="col-lg-2 col-form-label">Email</label>
                                <div class="col-lg-10">
                                    <input value="{{old('email', $user->email)}}" type="email" name="email" id="email"
                                        class="form-control" required>
                                    @error('email')
                                    <li class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </li>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Password" class="col-lg-2 col-form-label">Password</label>
                                <div class="col-lg-10">
                                    <input value="{{old('password')}}" type="password" name="password" id="password"
                                        class="form-control">
                                    @error('password')
                                    <li class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </li>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group row">
                        <div class="col-sm-4 col-sm-offset-2">
                            <a href="{{url('admin/teacher')}}" class="btn btn-white btn-sm">Cancel</a>
                            <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
function changePreviewImage() {
    var inputImage = $('#input-image').get(0).files[0];
    if (inputImage) {
        $("#preview-image").attr("hidden", false);
        $(`.fa.fa-paperclip#image-btn`).attr("class", "fa fa-pencil-square-o");
        $(`.btn.btn-primary#image-btn`).attr("class", "btn btn-warning");
        var reader = new FileReader();
        reader.onload = function() {
            $("#preview-image").attr("src", reader.result);
        }
        reader.readAsDataURL(inputImage);
    }
}
</script>
@endsection