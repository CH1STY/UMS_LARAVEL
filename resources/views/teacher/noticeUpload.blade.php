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
<div align="center">
    <form method="POST" action="">
        @csrf
    <h2 align="center" style="padding:2%">Upload Notices <span style="color:#D50000"><b>{{$teacher->username}}</b></span></h2>
            <p style="color:red">{{session('uploaded')}}</p>
            <textarea style="padding: 10px" name="details"  cols="100" rows="20"></textarea><br>
                <button class="btn btn-primary" type="submit" margin:5px">UPLOAD NOTICE</button>
    </form>
</div>
@endsection
