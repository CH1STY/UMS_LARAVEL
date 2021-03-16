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
        <td><h1>Student EDITING PAGE</h1></td>
        <td><a href="{{route('admin.view.student')}}"><button class="btn btn-dark">Back</button></a></td>
    </tr>
</table>
<p class="successMsg">{{session('msg')}} </p>

@if($student)


<form action="" enctype="multipart/form-data" method="post">
    @csrf
    <table class="table formTable">
        <tr>
           <td colspan="2"> <img class="profilePic" src=" @if ($student->profile_pic)
            {{asset($student->profile_pic)}}
            @else 
            {{asset('images/dummy.png')}}
            @endif" alt="">
            <input type="file" name="profile_pic" id="">
           </td>
           <td  style="vertical-align: middle" class="errorText">  {{ $errors->first('profile_pic')}}</td>
        </tr>
        <tr>
            <td class="labelT">Name:</td>
            <td><input class="inputF" type="text" name="name" id="" value="{{$student->name}}"></td>
            <td class="errorText">  {{ $errors->first('name')}}</td>
        </tr>
        <tr>
            <td class="labelT">Status:</td>
            <td>
                <select name="status" id="">
                    <option value="" selected>Select Status</option>
                    <option value="active" @if($student->status=='active') selected @endif >Active</option>
                    <option value="inactive" @if($student->status=='inactive') selected @endif>Inactive</option>
                </select>
            </td>
            <td class="errorText">  {{ $errors->first('status')}}</td>
        </tr>
        <tr>
            <td class="labelT">Student ID:</td>
            <td colspan="2">{{$student->student_id}}</td>
        </tr>
        <tr>
            <td class="labelT">Admin ID:</td>
            <td colspan="2">{{$student->admin_id}}</td>
        </tr>
        <tr>
            <td class="labelT">University ID:</td>
            <td colspan="2">{{$student->university_id}}</td>
        </tr>
        <tr>
            <td class="labelT">Address:</td>
            <td><input class="inputF" type="text" name="address" id="" value="{{$student->address}}" ></td>
            <td class="errorText">{{ $errors->first('address')}}</td>
        </tr>
        <tr>
            <td class="labelT">Date of Birth:</td>
            <td><input class="inputF" type="date" name="birthdate" id="" value="{{$student->birthdate}}" ></td>
            <td class="errorText">{{ $errors->first('birthdate')}}</td>
        </tr>
        <tr>
            <td class="labelT">Admission Date:</td>
            <td><input class="inputF" type="date" name="admission_date" id="" value="{{$student->admission_date}}" ></td>
            <td class="errorText">{{ $errors->first('admission_date')}}</td>
        </tr>
        <tr>
            <td class="labelT">Creation Date:</td>
            <td colspan="2">{{date('l jS \of F Y h:i:s A', strtotime($student->created_at))}}</td>
        </tr>
    </table>

   <div class="buttonDiv">
       <button class="btn btn-primary" type="submit">Update</button>
   </div> 
</form>

@else 

<h3 style="color:red" align="center">Student Id Error</h3>

@endif


@endsection 