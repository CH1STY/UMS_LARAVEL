@extends('layout.studentDashboard')

@section('pageTitle')
Student Home
@endsection

@section('extraCss')

@endsection

@section('profilePicSource')

@if ($student->profile_pic)
{{asset($student->profile_pic)}}
@else 
{{asset('images/dummy.png')}}
@endif

@endsection

@section('username')
{{$student->name}}
@endsection

@section('container')
<h2 align="center" style="padding:2%">EDIT YOUR PROFILE <span style="color:#D50000"><b>{{$student->username}}</b></span></h2>
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
                <td colspan="2" align="center"> <img src="@if ($student->profile_pic)
                    {{asset($student->profile_pic)}}
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
                <th scope="col"><input type="text" name="name" value="{{$student['name']}}"></th>
            </tr>
            <tr>
                <th scope="col">PHONE</th>
                <th scope="col"><input type="text" name="phone" value="{{$student['phone']}}"></th>
            </tr>
            <tr>
                <th scope="col">ADDRESS</th>
                <th scope="col"><input type="text" name="address" value="{{$student['address']}}"></th>
            </tr>
            <tr>
				<td></td>
                <td><button type="submit" name="submit" class="btn btn-success">UPDATE</button></td>
            </tr>
        </table>
        </form>
    </div>
@endsection