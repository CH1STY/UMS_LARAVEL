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
<h2 align="center" style="padding:2%">Account Data of <span style="color:#D50000"><b>{{$teacher->username}}</b></span></h2>
<div align="center">
<table align="center" class="table table-striped table-condensed table-hover"  style="width: 70%">

    <tr>
        <th scope="col">USER'S NAME</th>
        <th scope="col">{{$account->name}}</th>
    </tr>
    <tr>
        <th scope="col">USERNAME</th>
        <th scope="col">{{$account->username}}</th>
    </tr>
    <tr>
        <th scope="col">ACCOUNT ID</th>
        <th scope="col">{{$account->account_id}}</th>
    </tr>
    <tr>
        <th scope="col">EMAIL</th>
        <th scope="col">{{$account->email}}</th>
    </tr>
    <tr>
        <th scope="col">PHONE</th>
        <th scope="col">{{$account->phone}}</th>
    </tr>
    <tr>
        <th scope="col">SALARY</th>
        <th scope="col">{{$account->salary}}</th>
    </tr>
    <tr>
        <th scope="col">USER'S STATUS</th>
        <th scope="col">{{$account->status}}</th>
    </tr>
    <tr>
        <th scope="col">BIRTHDATE</th>
        <th scope="col">{{$account->birthdate}}</th>
    </tr>
    <tr>
        <td></td>
        <td><a href="{{route('teacher')}}">
            <button class="btn btn-info" style="margin:5px">BACK</button>
            <a href="{{route('teacher.accountPrint',['id'=>$teacher->teacher_id])}}">
                <button class="btn btn-primary" style="margin:5px">PRINT</button></a>
        </td>
    </tr>
</table>
{{session('msg')}}
<script src="{{ asset('js/app.js') }}" type="text/js"></script>
</div>

@endsection
