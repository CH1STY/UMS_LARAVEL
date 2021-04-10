@extends('layout.teacherDashboard')

@section('pageTitle')
Profile Page
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

@section('extraCss')
 <style>
     .propic{
         border: 3px solid gray;
         border-radius: 50%;
         width: 200px;
         height: 200px;
     }
 </style>
@endsection

@section('container')
    {{--<h1>This is the Main Body</h1>--}}
    <h2 align="center" style="padding:2%">Welcome <span style="color:#D50000"><b>{{$teacher->username}}</b></span></h2>

    <div align="center">
        {{session('resigned')}}
        <br>
        <table align="center" class="table table-striped table-condensed table-hover"  style="width: 70%">

            <tr style="font-size:20px;">
                <th scope="col">NAME</th>
                <th scope="col">{{$teacher['name']}}</th>
            </tr>
            <tr>
                <th scope="col">USERNAME</th>
                <th scope="col">{{$teacher['username']}}</th>
            </tr>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">{{$teacher['teacher_id']}}</th>
            </tr>
            <tr>
                <th scope="col">EMAIL</th>
                <th scope="col">{{$teacher['email']}}</th>
            </tr>
            <tr>
                <th scope="col">PHONE</th>
                <th scope="col">{{$teacher['phone']}}</th>
            </tr>
            <tr>
                <th scope="col">BIRTH DATE</th>
                <td>{{date('l jS \of F Y', strtotime($teacher['birthdate']))}}</td>
            </tr>
            <tr>
                <th scope="col">STATUS</th>
                <th scope="col">{{$teacher['status']}}</th>
            </tr>
            <tr>
                <th scope="col">ADDRESS</th>
                <th scope="col">{{$teacher['address']}}</th>
            </tr>
            <tr>
                <th scope="col">JOIN DATE</th>
                <td>{{$teacher['created_at']->format('d-m-Y')}}</td>
            </tr>
            <tr>
                <td></td>
				<td><a href="{{url()->previous()}}">
                    <button class="btn btn-success" style="margin:5px">BACK</button></a>
                    @if($teacher->status=='resigning')
                    <a href="{{route('teacher.deleteResigning')}}">
                    <button class="btn btn-danger" style="margin:5px">DELETE REQUEST</button></td></a>
                    @elseif($teacher->status=='active')
                    <a href="{{route('teacher.resigning')}}">
                        <button class="btn btn-danger" style="margin:5px">RESIGN REQUEST</button></td></a>
                    @else
                    <h4>YOU ARE RESIGNED</h4>
                    @endif
            </tr>
        </table>

    </div>

@endsection
