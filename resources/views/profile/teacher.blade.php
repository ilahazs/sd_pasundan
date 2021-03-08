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
<div class="col-md-6">

    <div class="profile-image">
        <img src="img/a4.jpg" class="rounded-circle circle-border m-b-md" alt="profile">
    </div>
    <div class="profile-info">
        <div class="">
            <div>
                <h2 class="no-margins">
                    {!! auth()->user()->name !!}
                </h2>
                <h4>Founder of Groupeq</h4>
                <small>
                    There are many variations of passages of Lorem Ipsum available, but the majority
                    have suffered alteration in some form Ipsum available.
                </small>
            </div>
        </div>
    </div>
</div>
<div class="col-md-3">
    <table class="table small m-b-xs">
        <tbody>
            <tr>
                <td>
                    <strong>142</strong> Projects
                </td>
                <td>
                    <strong>22</strong> Followers
                </td>

            </tr>
            <tr>
                <td>
                    <strong>61</strong> Comments
                </td>
                <td>
                    <strong>54</strong> Articles
                </td>
            </tr>
            <tr>
                <td>
                    <strong>154</strong> Tags
                </td>
                <td>
                    <strong>32</strong> Friends
                </td>
            </tr>
        </tbody>
    </table>
</div>
<div class="col-md-3">
    <small>Sales in last 24h</small>
    <h2 class="no-margins">206 480</h2>
    <div id="sparkline1"></div>
</div>
@endsection