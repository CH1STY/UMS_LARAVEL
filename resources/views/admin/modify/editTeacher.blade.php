@extends('layout.adminDashboard')

@section('pageTitle')

Edit Teacher
    
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

@endsection

@section('container')


<table style="width:100%">
    <tr>
        <td><h1>TEACHER EDITING PAGE</h1></td>
        <td><a href="{{route('admin.view.teacher')}}"><button class="btn btn-dark">Back</button></a></td>
    </tr>
</table>
<p class="successMsg">{{session('msg')}} </p>

@if($teacher)


<form action="" enctype="multipart/form-data" method="post">
    @csrf
    <table class="table formTable">
        <tr>
           <td colspan="2"> <img class="profilePic" src=" @if ($teacher->profile_pic)
            {{asset($teacher->profile_pic)}}
            @else 
            {{asset('images/dummy.png')}}
            @endif" alt="">
            <input type="file" name="profile_pic" id="">
           </td>
           <td  style="vertical-align: middle" class="errorText">  {{ $errors->first('profile_pic')}}</td>
        </tr>
        <tr>
            <td class="labelT">Name:</td>
            <td><input class="inputF" type="text" name="name" id="" value="{{$teacher->name}}"></td>
            <td class="errorText">  {{ $errors->first('name')}}</td>
        </tr>
        <tr>
            <td class="labelT">Salary:</td>
            <td><input class="inputF" type="number" name="salary" id="" value="{{$teacher->salary}}"></td>
            <td class="errorText">  {{ $errors->first('salary')}}</td>
        </tr>
        <tr>
            <td class="labelT">Status:</td>
            <td>
                <select name="status" id="">
                    <option value="" selected>Select Status</option>
                    <option value="active" @if($teacher->status=='active') selected @endif >Active</option>
                    <option value="inactive" @if($teacher->status=='inactive') selected @endif>Inactive</option>
                    <option value="resigned" @if($teacher->status=='resigned') selected @endif>Resigned</option>
                </select>
            </td>
            <td class="errorText">  {{ $errors->first('status')}}</td>
        </tr>
        <tr>
            <td class="labelT">Teacher ID:</td>
            <td colspan="2">{{$teacher->teacher_id}}</td>
        </tr>
        <tr>
            <td class="labelT">Admin ID:</td>
            <td colspan="2">{{$teacher->admin_id}}</td>
        </tr>
        <tr>
            <td class="labelT">University ID:</td>
            <td colspan="2">{{$teacher->university_id}}</td>
        </tr>
        <tr>
            <td class="labelT">Address:</td>
            <td><input class="inputF" type="text" name="address" id="" value="{{$teacher->address}}" ></td>
            <td class="errorText">{{ $errors->first('address')}}</td>
        </tr>
        <tr>
            <td class="labelT">Date of Birth:</td>
            <td><input class="inputF" type="date" name="birthdate" id="" value="{{$teacher->birthdate}}" ></td>
            <td class="errorText">{{ $errors->first('birthdate')}}</td>
        </tr>
        <tr>
            <td class="labelT">Creation Date:</td>
            <td colspan="2">{{date('l jS \of F Y h:i:s A', strtotime($teacher->created_at))}}</td>
        </tr>
    </table>

   <div class="buttonDiv">
       <button class="btn btn-primary" type="submit">Update</button>
   </div> 
</form>

@else 

<h3 style="color:red" align="center">Teacher Id Error</h3>

@endif


@endsection 