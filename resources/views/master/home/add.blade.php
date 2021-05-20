@extends('layouts.app')

@section('title', 'Add Home Data')

@section('head')
@endsection

@section('heading')
<h2>Tambah Data Home</h2>
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{url('/')}}">Home</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{url('/admin/master/home')}}">Data Home Table</a>
    </li>
    <li class="breadcrumb-item">
        <strong>Add Data</strong>
    </li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Data Home</h5>
            </div>
            <div class="ibox-content">
                <form action="{{url('admin/master/home')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="Section" class="col-lg-2 col-form-label">Section</label>
                        <div class="col-lg-10">
                            <!-- <input required value="{{old('section')}}" type="text" required name="section" id="section" class="form-control"> -->
                            <select required name="type" id="type" class="form-control">
                                <option value="" selected disabled>- PILIH TYPE -</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Type" class="col-lg-2 col-form-label">Type</label>
                        <div class="col-lg-10">
                            <select required onchange="itemChange()" name="type" id="type" class="form-control">
                                <option value="" selected disabled>- PILIH TYPE -</option>
                                <option {{ old('type') == 'wording' ? "selected" : "" }} value="wording">Wording
                                </option>
                                <option {{ old('type') == 'image' ? "selected" : "" }} value="image">Image</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Item" class="col-lg-2 col-form-label">Content</label>
                        <div class="col-lg-10 item-content">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group row">
                        <div class="col-sm-4 col-sm-offset-2">
                            <a href="{{route('home')}}" class="btn btn-white btn-sm">Cancel</a>
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
function itemChange() {
    $('.item-content').empty();
    var type = $('#type').val();
    if (type == 'image') {
        var content = `<label class="label-image">
                                <img id="preview-image" class="m-xs img-md" hidden>
                                <div class="btn-group-sm text-center">
                                    <label class="btn btn-primary" id="image-btn">
                                        <i class="fa fa-paperclip" id="image-btn"></i>
                                        <input value="{{old('content')}}" type="file" onchange="changePreviewImage()" id="input-image" name="content" hidden accept=".png, .jpg, .jpeg"> 
                                    </label>
                                </div>
                            </label>
                            @error('type')
                                <li class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </li>
                            @enderror`;
    } else {
        var content = `<input value="{{old('content')}}" type="text" name="content" id="content" class="form-control">`;
    }
    $('.item-content').append(content);
}

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