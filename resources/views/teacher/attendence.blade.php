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
<div align="center">

    <h2 align="center" style="padding:2%">Upload Attendence <span style="color:#D50000"><b>{{$teacher->username}}</b></span></h2>
    <form action="{{ route('teacher.attendence.post') }}" method="POST" enctype="multipart/form-data">
        @csrf
            <p style="color:red">{{session('success')}}</p>
            <input type="file" name="file" class="btn btn-secondary" id="">
            <button type="submit" class="btn btn-success" style="margin:5px">Upload Student Attendence</button>
    </form>
            <a href="{{route('teacher.studentAttendence')}}" align="center">
                <button class="btn btn-success" style="margin:5px">Download Student Attendence</button></a>

</div>
@endsection
