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
    {{session('delete')}}
    <h2 align="center" style="padding:2%">STUDENT LIST </h2>
    <table class="table tableCustom" align="center">
        <thead>
            <tr>
                <th>STUDENT ID</th>
                <th>COURSE ID</th>
                <th>STUDENT STATUS</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($student as $list)
            <tr>
                <td>{{$list->student_id}}</td>
                <td>{{$list->course_id}}</td>
                <td style="color:red">{{$list->status}}</td>
                <td><a href="{{route('teacher.studentdetails',['id'=>$list->student_id])}}"><button class="btn btn-primary">Details</button></a>
                    <a href="{{route('teacher.addedstudentcourse',['id'=>$list->student_id])}}" onclick="return confirm('Are you sure?')"><button class="btn btn-danger">ADD</button></a></td>
            </tr>

            @endforeach
        </tbody>
    </table>
@endsection
