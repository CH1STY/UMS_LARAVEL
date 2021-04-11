@extends('layout.teacherDashboard')

@section('pageTitle')
Edit Profile
@endsection

@section('profilePicSource')

@if ($teacher->profile_pic)
{{asset($teacher->profile_pic)}}
@else
{{asset('images/dummy.png')}}
@endif

@endsection

@section('username')
{{$teacher->username}}
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
    <h2 align="center" style="padding:2%">EDIT YOUR PROFILE <span style="color:#D50000"><b>{{$teacher->username}}</b></span></h2>
    {{--<h6 align="center" style="color:red">{{$errors->first('profile_picture')}}</h6>--}}
    <p style="color:red">{{session('msg')}} </p>
    @foreach ($errors->all() as $err)
                <p style="color:red">{{$err}}</p>
            @endforeach
    <div align="center">
        <br>
        <form method="POST" action="" enctype= "multipart/form-data">
            @csrf
        <table align="center" class="table table-striped table-condensed table-hover"  style="width: 70%">
            <tr>
                <td colspan="2" align="center"> <img src="@if ($teacher->profile_pic)
                    {{asset($teacher->profile_pic)}}
                    @else
                    {{asset('images/dummy.png')}}
                    @endif" alt="" class="propic">
                    <div style="vertical-align: bottom;" >

                            <input type="file" name="profile_pic" id="">
                            {{--<button type="submit" class="btn btn-info">Upload</button>--}}

                    </div>
                </td>
            </tr>

            <tr style="font-size:20px;">
                <th scope="col">NAME</th>
                <th scope="col"><input type="text" name="name" value="{{$teacher['name']}}"></th>
            </tr>
            <tr>
                <th scope="col">EMAIL</th>
                <th scope="col"><input type="email" name="email" value="{{$teacher['email']}}"></th>
            </tr>
            <tr>
                <th scope="col">PHONE</th>
                <th scope="col"><input type="text" name="phone" value="{{$teacher['phone']}}"></th>
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
                <th scope="col"><input type="text" name="address" value="{{$teacher['address']}}"></th>
            </tr>
            <tr>
				<td></td>
                <td><button type="submit" name="submit" class="btn btn-success">UPDATE</button></td>
            </tr>
        </table>
        </form>
    </div>

@endsection
