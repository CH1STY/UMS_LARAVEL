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
<h2 align="center" style="padding:2%">NOTICE LIST </h2>
<table class="table tableCustom" align="center">
    <thead>
        <tr>
            <th>NOTICE ID</th>
            <th>NOTICE DETAILS</th>
            <th>DATE</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($notice as $list)
        <tr>
            <td>{{$list->notice_id}}</td>
            <td>{{$list->details}}</td>
            <td>{{$list->created_at}}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
