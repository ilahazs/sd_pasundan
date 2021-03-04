@extends('layouts.app')

@section('title', 'Dashboard')

@section('head')
@endsection

@section('heading')
    <h2>Dashboard</h2>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{url('/')}}">Home</a>
        </li>
        <li class="breadcrumb-item">
            <strong>Dashboard</strong>
        </li>
    </ol>
@endsection