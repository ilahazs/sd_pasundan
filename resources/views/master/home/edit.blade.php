@extends('layouts.app')

@section('title', 'Edit Home Data')

@section('head')
@endsection

@section('heading')
<h2>Edit Data Home</h2>
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{url('/')}}">Home</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{url('/admin/master/home')}}">Data Home Table</a>
    </li>
    <li class="breadcrumb-item">
        <strong>Edit Data</strong>
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
                <form action="{{url('admin/master/home/'.$home->id.'/update')}}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="Section" class="col-lg-2 col-form-label">Section</label>
                        <div class="col-lg-10">
                            <input disabled value="{{$home->section}}" type="text" required name="section" id="section"
                                class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Type" class="col-lg-2 col-form-label">Type</label>
                        <div class="col-lg-10">
                            <select disabled name="type" id="type" class="form-control">
                                <option value="" selected disabled>- PILIH TYPE -</option>
                                <option {{ $home->type == 'wording' ? "selected" : "" }} value="wording">Wording
                                </option>
                                <option {{ $home->type == 'image' ? "selected" : "" }} value="image">Image</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Item" class="col-lg-2 col-form-label">Content</label>
                        <div class="col-lg-10 item-content">
                            @if($home->type == 'image')
                            <label class="label-image">
                                <img id="preview-image" class="m-xs img-md"
                                    src="{{asset('landing-page/image/'.$home->content)}}">
                                <div class="btn-group-sm text-center">
                                    <label class="btn btn-primary" id="image-btn">
                                        <i class="fa fa-paperclip" id="image-btn"></i>
                                        <input value="{{old('content', $home->content)}}" type="file"
                                            onchange="changePreviewImage()" id="input-image" name="content" hidden
                                            accept=".png, .jpg, .jpeg">
                                    </label>
                                </div>
                            </label>
                            <!-- @error('type')
                                    <li class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </li>
                                @enderror -->
                            @else
                            <input value="{{old('content',$home->content)}}" type="text" name="content" id="content"
                                class="form-control">
                            @endif
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group row">
                        <div class="col-sm-4 col-sm-offset-2">
                            <a href="{{route('dashboard')}}" class="btn btn-white btn-sm">Cancel</a>
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