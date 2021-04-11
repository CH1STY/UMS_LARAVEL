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
    <h2 align="center" style="padding:2%">Welcome <span style="color:#D50000"><b>{{$teacher->username}}
    </b></span> It is view student page</h2>
    <table class="table tableCustom" align="center">
        <thead>
            <tr>
                <th>STUDENT ID</th>
                <th>COURSE ID</th>
                <th>STATUS</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($student as $list)
            <tr>
                <td>{{$list->student_id}}</td>
                <td>{{$list->course_id}}</td>
                <td>{{$list->status}}</td>
                <td><a href="{{route('teacher.studentdetails',['id'=>$list->student_id])}}">
                    <button class="btn btn-primary">Details</button></a></td>
            </tr>

            @endforeach
        </tbody>
    </table>
    {{--<div style="display:flex;justify-content:center;" >{{$student->appends(request()->input())->links()}}</div>--}}

@endsection
