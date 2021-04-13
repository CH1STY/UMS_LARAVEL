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
<div class="panel panel-primary">
    <div class="panel-heading" align="center" style="padding:2%"><h2>Collect Assignment </h2></div>
    <div class="panel-body">

      @if ($message = Session::get('success'))
      <div class="alert alert-success alert-block">
          <button type="button" class="close" data-dismiss="alert">×</button>
              <strong>{{ $message }}</strong>
      </div>

      @endif


      <div align="center" style="padding:2%">
        {{session('delete')}}
      <table align="center" class="table table-condensed table-hover "  style="width: 70%">
        <thead class="thead-dark" align="center">
            <th scope="col">ASSIGNMENT ID</th>
            <th scope="col">STUDENT ID</th>
            <th scope="col">ACTION</th>
        </thead>
        <tbody>
            @foreach ($assignment as $ac)
                <tr align="center">
                    <th scope="col">{{$ac->assignment_id}}</th>
                    <th scope="col">{{$ac->student_id}}</th>
                    <th scope="col">
                        <a href="#"><button class="btn btn-info">DOWNLOAD</button></a>
                        <a href="#" onclick="return confirm('Are you sure?')">
                            <button class="btn btn-danger">DELETE</button></th></a>
                </tr>
            @endforeach
        </tbody>
      </table>
    </div>
    {{session('msg')}}
    </div>
    </div>
  </div>
@endsection
