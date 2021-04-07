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
    <a href="{{route('admin.course.view',['sortTab'=>'subject'])}}"><button id="subjectTab" class="tablinks" onclick="openCourse(event, 'Subject')">Subject</button></a>
    <a href="{{route('admin.course.view',['sortTab'=>'course'])}}"><button id="courseTab" class="tablinks" onclick="openCourse(event, 'Course')">Course</button></a>
    
  </div>
  
  <div id="Subject" class="tabcontent">
    
    <table class="table customTable">
        <thead>
            <th><a href="{{route('admin.course.view',['sortTab'=>'subject','sort'=>'sname','sortType'=>$sortType,])}}" > Subject Name @if(request('sort')=='sname') @if(request('sortType')=='asc') &uarr;  @elseif(request('sortType')=='desc') &darr; @endif  @endif</a></th>
            <th><a href="{{route('admin.course.view',['sortTab'=>'subject','sort'=>'suname','sortType'=>$sortType,])}}" > University Name @if(request('sort')=='suname') @if(request('sortType')=='asc') &uarr;  @elseif(request('sortType')=='desc') &darr; @endif  @endif</a></th>
            <th><a href="{{route('admin.course.view',['sortTab'=>'subject','sort'=>'sdname','sortType'=>$sortType,])}}" > Department Name @if(request('sort')=='sdname') @if(request('sortType')=='asc') &uarr;  @elseif(request('sortType')=='desc') &darr; @endif  @endif</a></th> 
        </thead>
        <tbody>
            
        </tbody>

    </table>
</div>

<div id="Course" class="tabcontent">
    <table class="table customTable">
        <thead>
            <th><a href="{{route('admin.course.view',['sortTab'=>'course','sort'=>'cname','sortType'=>$sortType,])}}" > Course Name @if(request('sort')=='cname') @if(request('sortType')=='asc') &uarr;  @elseif(request('sortType')=='desc') &darr; @endif  @endif</a></th>
            <th><a href="{{route('admin.course.view',['sortTab'=>'course','sort'=>'csname','sortType'=>$sortType,])}}" > Subject Name @if(request('sort')=='csname') @if(request('sortType')=='asc') &uarr;  @elseif(request('sortType')=='desc') &darr; @endif  @endif</a></th>
            <th><a href="{{route('admin.course.view',['sortTab'=>'course','sort'=>'cuname','sortType'=>$sortType,])}}" > University Name @if(request('sort')=='cuname') @if(request('sortType')=='asc') &uarr;  @elseif(request('sortType')=='desc') &darr; @endif  @endif</a></th>
            <th><a href="{{route('admin.course.view',['sortTab'=>'course','sort'=>'cdname','sortType'=>$sortType,])}}" > Department Name @if(request('sort')=='cdname') @if(request('sortType')=='asc') &uarr;  @elseif(request('sortType')=='desc') &darr; @endif  @endif</a></th>
            <th><a href="{{route('admin.course.view',['sortTab'=>'course','sort'=>'csemester','sortType'=>$sortType,])}}" > Semester @if(request('sort')=='csemester') @if(request('sortType')=='asc') &uarr;  @elseif(request('sortType')=='desc') &darr; @endif  @endif</a></th>
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

            {{$courseList->links()}}

        </tbody>

    </table>
  </div>


  <script>
    function openCourse(evt, courseName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(courseName).style.display = "block";
        if(courseName=="Subject")
        {
            document.getElementById('subjectTab').className += " active";
        }
        else if(courseName=="Course")
        {
            document.getElementById('courseTab').className += " active";
        }
        else
        {
            evt.currentTarget.className += ' active';
        }
    }
    @if(request('sortTab'))
    openCourse(event,@if(request('sortTab')=='subject') 'Subject' @elseif(request('sortTab')=='course') 'Course' @else 'Subject' @endif );
    @endif
</script>


@endsection
