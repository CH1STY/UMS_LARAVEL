@extends('layout.studentDashboard')

@section('pageTitle')
Student Home
@endsection

@section('extraCss')

@endsection

@section('profilePicSource')

@if ($student->profile_pic)
{{asset($student->profile_pic)}}
@else 
{{asset('images/dummy.png')}}
@endif

@endsection

@section('username')
{{$student->name}}
@endsection

@section('container')
    <h1></h1>
@endsection