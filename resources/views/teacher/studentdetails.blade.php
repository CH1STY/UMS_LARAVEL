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
<h2 align="center" style="padding:2%">{{$student->name}}'s STUDENT DETAILS</h2>
<div align="center">
    <br>
    <table align="center" class="table table-striped table-condensed table-hover"  style="width: 70%">
        <tr style="font-size:20px;">
            <th scope="col">STUDENT NAME</th>
            <th scope="col">{{$student->name}}</th>
        </tr>
        <tr>
            <th scope="col">STUDENT ID</th>
            <th scope="col">{{$student->student_id}}</th>
        </tr>
        <tr>
            <th scope="col">EMAIL</th>
            <th scope="col">{{$student->email}}</th>
        </tr>
        <tr>
            <th scope="col">PHONE</th>
            <th scope="col">{{$student->phone}}</th>
        </tr>
        <tr>
            <th scope="col">BIRTH DATE</th>
            <th scope="col">{{date('l jS \of F Y', strtotime($student->birthdate))}}</th>
        </tr>
        <tr>
            <th scope="col">CREDITS COMPLETED</th>
            <th scope="col">{{$student->credits_completed}}</th>
        </tr>
        <tr>
            <th scope="col">CGPA</th>
            <th scope="col">{{$student->CGPA}}</th>
        </tr>
        <tr>
            <th scope="col">ADDRESS</th>
            <th scope="col">{{$student->address}}</th>
        </tr>
        <tr>
            <th scope="col">STATUS</th>
            <th scope="col">{{$student->status}}</th>
        </tr>
        <tr>
            <th scope="col">ADMISSION DATE</th>
            <th scope="col">{{$student->admission_date}}</th>
        </tr>
    </table>
        <a href="{{url()->previous()}}" align="center">
        <button class="btn btn-success" style="margin:5px">BACK</button></a>
    {{session('msg')}}
</div>
@endsection
