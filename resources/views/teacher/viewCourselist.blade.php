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
    {{--<h1>This is the Main Body</h1>--}}
    <h2 align="center" style="padding:2%">ALL COURSE LIST</h2>

    <table class="table tableCustom" align="center">
        <thead>
            <tr>
                @php
                if($sortType=='asc') {$sortType='desc';}
                else
                {$sortType='asc';}
                @endphp

                <th><a href="{{route('teacher.viewCourselist',['sort'=>'course_id','sortType'=>$sortType,])}}">COURSE ID @if(request('sort')=='course_id') @if(request('sortType')=='asc') &uarr;  @elseif(request('sortType')=='desc') &darr; @endif  @endif</a></th>
                <th><a href="{{route('teacher.viewCourselist',['sort'=>'name','sortType'=>$sortType,])}}">COURSE NAME @if(request('sort')=='name') @if(request('sortType')=='asc') &uarr;  @elseif(request('sortType')=='desc') &darr; @endif  @endif</a></th>
                <th><a href="{{route('teacher.viewCourselist',['sort'=>'credits','sortType'=>$sortType,])}}">COURSE CREDIT @if(request('sort')=='credits') @if(request('sortType')=='asc') &uarr;  @elseif(request('sortType')=='desc') &darr; @endif  @endif</a></th>
                <th><a href="{{route('teacher.viewCourselist',['sort'=>'dname','sortType'=>$sortType,])}}">DEPARTMENT NAME @if(request('sort')=='dname') @if(request('sortType')=='asc') &uarr;  @elseif(request('sortType')=='desc') &darr; @endif  @endif</a></th>
                <th><a href="{{route('teacher.viewCourselist',['sort'=>'created_at','sortType'=>$sortType,])}}">CREATED AT @if(request('sort')=='created_at') @if(request('sortType')=='asc') &uarr;  @elseif(request('sortType')=='desc') &darr; @endif  @endif</a></th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($course as $list)
            <tr>
                <td>{{$list->course_id}}</td>
                <td>{{$list->name}}</td>
                <td>{{$list->credits}}</td>
                <td>{{$list->dname}}</td>
                <td>{{$list->created_at}}</td>
                <td><button class="btn">Details</button></td>
            </tr>

            @endforeach
        </tbody>
    </table>
    <div style="display:flex;justify-content:center;" >{{$course->links()}}</div>
@endsection
