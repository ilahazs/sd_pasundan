@extends('layouts.app')

@section('title', 'Profile')

@section('heading')
<h2>Profile</h2>
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{url('/')}}">Home</a>
    </li>
    <li class="breadcrumb-item">
        <strong>Profile</strong>
    </li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-md-5">
        <div class="ibox">
            <div class="ibox-title">
                My Profile
            </div>
            <div>
                <div class="ibox-content no-padding border-left-right">
                    <img src="{{asset('/img/profile-image/'.$user->profile_image)}}" alt="photo-profile"
                        class="img-fluid">
                </div>
                <div class="ibox-content profile-content">
                    <h4><strong>{!! $user->name !!}</strong></h4>
                    <table class="table m-b-xs">
                        <tbody>
                            <tr>
                                <td>
                                    <strong>Nomer Telepon:</strong><br>{!! $user->phone !!}
                                </td>
                                <td>
                                    <strong>Jenis Kelamin :</strong><br>
                                    @if($user->gender == 'p')
                                    Perempuan
                                    @else
                                    Laki - laki
                                    @endif
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    <strong>Nomor Induk :</strong><br>
                                    {!! $user->nis !!}
                                </td>
                                <td>
                                    <strong>Nomor Induk Nasional:</strong><br>
                                    {!! $user->nisn !!}
                                </td>
                            </tr>
                            <tr>
                                <th style="text-align: center !important;" colspan="2">
                                    Login Account
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Email: </strong><br>{!! auth()->user()->email !!}
                                </td>
                                <td>
                                    <strong>Role: </strong><br>{!! ucfirst(auth()->user()->role) !!}
                                </td>
                            </tr>
                            <tr>
                                <th style="text-align: center !important;" colspan="2">
                                    <a href="{{url('/admin/teacher/'.$user->id.'/edit')}}"
                                        class="btn btn-sm btn-warning">Edit Profile</a>
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Aktivitas</h5>
            </div>
            <div class="ibox-content">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem, nemo nam sint id repellendus
                consectetur quo necessitatibus quos ad rerum iste a ipsam perspiciatis quod debitis voluptate deserunt
                laborum. Numquam maiores repudiandae dolor veritatis nihil quam doloremque, odio quas harum
                reprehenderit beatae ea corporis, ex corrupti laborum. Dignissimos delectus tempora nam aut repellat
                nostrum nulla error, quos quia tempore recusandae praesentium minus esse soluta, sit ipsa quibusdam
                tenetur? Recusandae maxime esse, sint vero a fugiat unde nemo odio tempora impedit veritatis, ex quam
                magni aliquam dicta voluptas cupiditate earum mollitia et eum, beatae laudantium aliquid iure amet.
                Eveniet nihil velit mollitia sint repudiandae maiores in qui vitae officia provident! Excepturi repellat
                cum dolores natus mollitia, enim quos temporibus sint impedit molestias quod quo itaque consequatur
                minus, labore similique neque? Sapiente, optio. Eum minus illo ratione odio quo tenetur neque quia ipsa
                ducimus. Beatae earum voluptas exercitationem enim, minus quia eius rerum perferendis sint itaque
                dolorem quis, cupiditate amet vel dicta provident. Eius iure aspernatur voluptatem ducimus ullam
                corporis aliquid, minus quidem eos sequi corrupti porro id vero commodi cumque expedita praesentium
                repellat, necessitatibus laudantium odit officia. Placeat cum assumenda, quidem qui a consectetur
                asperiores aut eius commodi illo? Facilis, deleniti!
            </div>
        </div>
    </div>
</div>
@endsection