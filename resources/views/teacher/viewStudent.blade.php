@extends('layout.teacherDashboard')

@section('pageTitle')
Teacher Home
@endsection

@section('extraCss')

@endsection

@section('profilePicSource')

@if ($teacher->profile_pic)
{{asset($teacher->profile_pic)}}
@else
{{asset('images/dummy.png')}}
@endif

@endsection


@section('username')
{{$teacher->name}}
@endsection

@section('container')
    {{--<h1>This is the Main Body</h1>--}}
    <h2 align="center" style="padding:2%">Welcome  <span style="color:#D50000"><b>{{$teacher->username}}</b></span> It is view student page</h2>

@endsection
