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
    <div class="panel-heading" align="center" style="padding:2%"><h2>Upload notes for {{$course->course_id}}</h2></div>
    <div class="panel-body">

      @if ($message = Session::get('success'))
      <div class="alert alert-success alert-block">
          <button type="button" class="close" data-dismiss="alert">×</button>
              <strong>{{ $message }}</strong>
      </div>

      @endif

      @if (count($errors) > 0)
          <div class="alert alert-danger">
              <strong>Whoops!</strong> There were some problems with your input.
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif

      <form action="{{ route('teacher.noteUpload.post',['id'=>$course->course_id]) }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="row">

              <div class="col-md-6">
                  <input type="file" name="file" class="form-control">
              </div>

              <div class="col-md-6">
                  <button type="submit" class="btn btn-success">Upload</button>
              </div>

          </div>
      </form>
      <div align="center" style="padding:2%">
        {{session('delete')}}
      <table align="center" class="table table-condensed table-hover "  style="width: 70%">
        <thead class="thead-dark" align="center">
            <th scope="col">NOTE ID</th>
            <th scope="col">VIEW NOTE</th>
        </thead>
        <tbody>
            @foreach ($note as $nc)
                <tr align="center">
                    <th scope="col">{{$nc->note_id}}</th>
                    <th scope="col">
                        <a href="{{route('teacher.notedownload',['id'=>$nc->note_id])}}"><button class="btn btn-info">DOWNLOAD</button></a>
                        <a href="{{route('teacher.notedelete',['id'=>$nc->note_id])}}" onclick="return confirm('Are you sure?')">
                            <button class="btn btn-primary">DELETE</button></th></a>
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
