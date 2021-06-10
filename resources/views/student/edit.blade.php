@extends('layouts.app')

@section('title', 'Edit Siswa')

@section('head')

@endsection

@section('heading')
<h2>Ubah Data Siswa</h2>
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{url('/')}}">Home</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{url('/siswa')}}">Table Siswa</a>
    </li>
    <li class="breadcrumb-item">
        <strong>Edit Siswa</strong>
    </li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title">
                <h5>Data Siswa</h5>
            </div>
            <div class="ibox-content">
                <form action="{{url('admin/student/'.$siswa->id)}}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="Name" class="col-lg-2 col-form-label">Name</label>
                        <div class="col-lg-10">
                            <input value="{{old('name', $siswa->name)}}" required type="text" name="name" id="name"
                                class="form-control">
                            @error('name')
                            <li class="text-danger">
                                <strong>{{ $message }}</strong>
                            </li>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Nis" class="col-lg-2 col-form-label">NIS</label>
                        <div class="col-lg-5">
                            <input value="{{old('nis', $siswa->nis)}}" required type="text" name="nis" id="nis"
                                class="form-control">
                            @error('nis')
                            <li class="text-danger">
                                <strong>{{ $message }}</strong>
                            </li>
                            @enderror
                        </div>
                        <label for="Nisn" class="col-lg-1 col-form-label">NISN</label>
                        <div class="col-lg-4">
                            <input value="{{old('nisn', $siswa->nisn)}}" required type="text" name="nisn" id="nisn"
                                class="form-control">
                            @error('nisn')
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
                                <option {{ old('gender', $siswa->gender) == 'l' ? "selected" : "" }} value="l">Laki-laki
                                </option>
                                <option {{ old('gender', $siswa->gender) == 'p' ? "selected" : "" }} value="p">Perempuan
                                </option>
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
                                <input value="{{old('phone', $siswa->phone)}}" required type="text" name="phone"
                                    id="phone" class="form-control">
                            </div>
                            @error('phone')
                            <li class="text-danger">
                                <strong>{{ $message }}</strong>
                            </li>
                            @enderror
                        </div>
                    </div>
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Akun Siswa</h5>
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
                            <a href="{{ URL::previous() }}" class="btn btn-white btn-sm">Cancel</a>
                            <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection