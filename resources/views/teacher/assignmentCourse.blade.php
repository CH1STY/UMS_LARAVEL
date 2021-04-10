@extends('layout.teacherDashboard')

@section('pageTitle')
Teacher Home
@endsection

@section('extraCss')
<link rel="stylesheet" href="{{asset('css/teacher/table.css')}}">

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
<h2 align="center" style="padding:2%">COURSE LIST </h2>
<table class="table tableCustom" align="center">
    <thead>
        <tr>
            <th>COURSE ID</th>
            <th>COURSE NAME</th>
            <th>COURSE STATUS</th>
            <th>ACTION</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($course as $list)
        <tr>
            <td>{{$list->course_id}}</td>
            <td>{{$list->name}}</td>
            @if($list->status=='completed')
            <td style="color:#D50000"><b>{{$list->status}}</b></td>
            @else
            <td style="color:green"><b>{{$list->status}}</b></td>
            @endif
            <td><a href="{{route('teacher.assignmentUpload',['id'=>$list->course_id])}}">
                <button class="btn btn-primary">View Assignment</button></a></td>
        </tr>

        @endforeach
    </tbody>
</table>

@endsection
