@extends('layout.adminDashboard')

@section('pageTitle')

Course and Subjects
    
@endsection



@section('profilePicSource')

    @if ($admin->profile_pic)
    {{asset($admin->profile_pic)}}
    @else 
    {{asset('images/dummy.png')}}
    @endif
    
@endsection

@section('username')

{{$admin->name}}
    
@endsection

@section('extraCss')
<link rel="stylesheet" href="{{asset('css/admin/table.css')}}">
<link rel="stylesheet" href="{{asset('css/admin/tab.css')}}">

<script>
    function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
    }
</script>

@endsection

@section('container')

<h1 align="center">Courses and Subjects</h1>
<p class="successMsg">{{session('msg')}} </p>


@php 
if($sortType=='asc') {$sortType='desc';} 
else 
{$sortType='asc';}   
@endphp

<div class="tab">
    <button class="tablinks active" onclick="openCity(event, 'Subject')">Subject</button>
    <button class="tablinks" onclick="openCity(event, 'Course')">Course</button>
    
  </div>
  
  <div id="Subject" class="tabcontent">
    
    <table class="table customTable">
        <thead>
            <th><a href="{{route('admin.course.view',['sort'=>'sname','sortType'=>$sortType,])}}" > Subject Name @if(request('sort')=='sname') @if(request('sortType')=='asc') &uarr;  @elseif(request('sortType')=='desc') &darr; @endif  @endif</a></th>
            <th><a href="{{route('admin.course.view',['sort'=>'suname','sortType'=>$sortType,])}}" > University Name @if(request('sort')=='suname') @if(request('sortType')=='asc') &uarr;  @elseif(request('sortType')=='desc') &darr; @endif  @endif</a></th>
            <th><a href="{{route('admin.course.view',['sort'=>'sdname','sortType'=>$sortType,])}}" > Department Name @if(request('sort')=='sdname') @if(request('sortType')=='asc') &uarr;  @elseif(request('sortType')=='desc') &darr; @endif  @endif</a></th> 
        </thead>
        <tbody>
            
        </tbody>

    </table>
</div>

<div id="Course" class="tabcontent">
    <table class="table customTable">
        <thead>
            <th><a href="{{route('admin.course.view',['sort'=>'cname','sortType'=>$sortType,])}}" > Course Name @if(request('sort')=='cname') @if(request('sortType')=='asc') &uarr;  @elseif(request('sortType')=='desc') &darr; @endif  @endif</a></th>
            <th><a href="{{route('admin.course.view',['sort'=>'csname','sortType'=>$sortType,])}}" > Subject Name @if(request('sort')=='csname') @if(request('sortType')=='asc') &uarr;  @elseif(request('sortType')=='desc') &darr; @endif  @endif</a></th>
            <th><a href="{{route('admin.course.view',['sort'=>'cuname','sortType'=>$sortType,])}}" > University Name @if(request('sort')=='cuname') @if(request('sortType')=='asc') &uarr;  @elseif(request('sortType')=='desc') &darr; @endif  @endif</a></th>
            <th><a href="{{route('admin.course.view',['sort'=>'cdname','sortType'=>$sortType,])}}" > Department Name @if(request('sort')=='cdname') @if(request('sortType')=='asc') &uarr;  @elseif(request('sortType')=='desc') &darr; @endif  @endif</a></th>
            <th><a href="{{route('admin.course.view',['sort'=>'csemester','sortType'=>$sortType,])}}" > Semester @if(request('sort')=='csemester') @if(request('sortType')=='asc') &uarr;  @elseif(request('sortType')=='desc') &darr; @endif  @endif</a></th>
        </thead>
        <tbody>
            @foreach ($courseList as $course)
            <tr>
                <td>{{$course->cname}}</td>
                <td>{{$course->csname}}</td>
                <td>{{$course->cuname}}</td>
                <td>{{$course->cdname}}</td>
                <td>{{$course->csemester}}</td>
            </tr>
                
            @endforeach
        </tbody>

    </table>
  </div>

    
@endsection
