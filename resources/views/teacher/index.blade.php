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
    <h2 align="center" style="padding:2%">Welcome  <span style="color:#D50000"><b>{{$teacher->username}}</b></span></h2>

    {{--University Card Design--}}
    <div align="center" style="padding:2%">
        <div class="card" >
          <div class="card-header" style="background-color: #ef5d7a">
            <h2 style="color:white">University</h2>
          </div>
          <div class="card-body">
            <h4 class="card-title">Dear Faculties</h4>
            <p class="card-text">As you all know that this is an education institution, you will have to mainain the students as well as
              have to maintain some rules and regulations.<br> Please go through the policies and if there is any query related to policies
              or any other problem you can let us know by mailing us.
            </p>
            <a href="#" class="btn btn-primary">University Policy</a>
          </div>
        </div>
      </div>

    {{--Course Showing--}}
    <?php $count=1;?>
    @foreach ($course as $c)
        @foreach ( $teacherCourse as $tc)
          @if($c['course_id']==$tc['course_id'])
             <div align="center" style="padding:2% ">
                <div style="width:70%" align="left">
                    <div class="card">
                      <div class="card-body">
                        <h3 class="card-title" style="color:crimson">{{$c['name']}}</h3>
                        <p class="card-text">You will get to know about course details and students of this current course.</p>
                        <a href="{{route('teacher.courseDetails',['course_id'=>$tc->course_id,])}}" class="btn btn-primary">Go to course</a>
                      </div>
                    </div>
                </div>
             </div>
         @endif
        @endforeach
    @endforeach
@endsection
