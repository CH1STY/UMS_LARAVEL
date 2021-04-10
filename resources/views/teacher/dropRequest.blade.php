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
{{session('drop')}}
    <h2 align="center" style="padding:2%">DROP REQUESTS </h2>
    <table class="table tableCustom" align="center">
        <thead>
            <tr>
                <th>STUDENT ID</th>
                <th>COURSE ID</th>
                <th>STUDENT STATUS</th>
                <th align="center">ACTION</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($drop as $list)
            <tr>
                <td>{{$list->student_id}}</td>
                <td>{{$list->course_id}}</td>
                <td style="color:red">REQUESTIONG TO DROP</td>
                <td><a href="{{route('teacher.droppingCancel',['cid'=>$list->course_id, 'sid'=>$list->student_id])}}"
                    onclick="return confirm('Are you sure?')"><button class="btn btn-primary">CANCEL DROPPING</button></a>
                    <a href="{{route('teacher.dropping',['cid'=>$list->course_id, 'sid'=>$list->student_id])}}"
                    onclick="return confirm('Are you sure?')"><button class="btn btn-danger">DROP STUDENT</button></a>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
