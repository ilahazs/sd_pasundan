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
<div class="row m-b-lg m-t-lg">
    <div class="col-md-6">
        <div class="profile-image">
            <img src="{{asset('/img/profile-image/'.$user->profile_image)}}" width="100%"
                alt="profile">
        </div>
        <div class="profile-info">
            <div class="">
                <div>
                    <h2 class="no-margins">
                        {!! $user->name !!}
                        <strong>{!! $user->degree !!}</strong>
                    </h2>
                    <h4>NIP. {!! $user->nip !!}</h4>
                    <!-- <small>
                        There are many variations of passages of Lorem Ipsum available, but the majority
                        have suffered alteration in some form Ipsum available.
                    </small> -->
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <table class="table small m-b-xs">
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
                        <strong>Gelar :</strong><br>
                        {!! $user->degree !!}
                    </td>
                    <td></td>
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
                        <a href="{{url('/admin/teacher/'.$user->id.'/edit')}}" class="btn btn-sm btn-warning">Edit Profile</a>
                    </th>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="ibox">
            <div class="ibox-content">
                <h3>About {!! ucfirst($user->name) !!} <strong>{!! $user->degree !!}</strong></h3>
                <p class="small">
                    There are many variations of passages of Lorem Ipsum available, but the majority have suffered
                    alteration in some form, by injected humour, or randomised words which don't.
                    <br />
                    <br /> If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything
                    embarrassing
                </p>
            </div>
        </div>
    </div>
    <div class="col-lg-6 m-b-lg">
        <div id="vertical-timeline" class="vertical-container light-timeline no-margins">
            <div class="vertical-timeline-block">
                <div class="vertical-timeline-icon navy-bg">
                    <i class="fa fa-briefcase"></i>
                </div>

                <div class="vertical-timeline-content">
                    <h2>Monday</h2>
                    <p>Conference on the sales results for the previous year. Monica please examine sales trends in
                        marketing and products. Below please find the current status of the sale.
                    </p>
                    <a href="#" class="btn btn-sm btn-primary"> More</a>
                    <!-- <span class="vertical-date">
                        Today <br>
                        <small>Dec 24</small>
                    </span> -->
                </div>
            </div>

            <div class="vertical-timeline-block">
                <div class="vertical-timeline-icon blue-bg">
                    <i class="fa fa-file-text"></i>
                </div>

                <div class="vertical-timeline-content">
                    <h2>Tuesday</h2>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                        the industry's standard dummy text ever since.</p>
                    <a href="#" class="btn btn-sm btn-success">More</a>
                </div>
            </div>

            <div class="vertical-timeline-block">
                <div class="vertical-timeline-icon lazur-bg">
                    <i class="fa fa-coffee"></i>
                </div>

                <div class="vertical-timeline-content">
                    <h2>Wednesday</h2>
                    <p>Go to shop and find some products. Lorem Ipsum is simply dummy text of the printing and
                        typesetting industry. Lorem Ipsum has been the industry's. </p>
                    <a href="#" class="btn btn-sm btn-info">More</a>
                </div>
            </div>

            <div class="vertical-timeline-block">
                <div class="vertical-timeline-icon yellow-bg">
                    <i class="fa fa-phone"></i>
                </div>

                <div class="vertical-timeline-content">
                    <h2>Thursday</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, optio, dolorum provident rerum
                        aut hic quasi placeat iure tempora laudantium ipsa ad debitis unde? Iste voluptatibus minus
                        veritatis qui ut.</p>
                    <a href="#" class="btn btn-sm btn-warning">More</a>
                </div>
            </div>

            <div class="vertical-timeline-block">
                <div class="vertical-timeline-icon navy-bg">
                    <i class="fa fa-comments"></i>
                </div>

                <div class="vertical-timeline-content">
                    <h2>Friday</h2>
                    <p>Web sites still in their infancy. Various versions have evolved over the years, sometimes by
                        accident, sometimes on purpose (injected humour and the like). </p>
                    <a href="#" class="btn btn-sm btn-success">More</a>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection