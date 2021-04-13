@extends('layout.studentDashboard')

@section('pageTitle')

Student Details
    
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

@section('extraCss')
<link rel="stylesheet" href="{{asset('css/admin/table.css')}}">

@endsection

@section('container')


<table style="width:100%">
    <tr>
        <td><h1>STUDENT PROFILE</h1></td>
        <td><a href="{{route('student')}}"><button class="btn btn-dark">Back</button></a></td>
    </tr>
</table>
<p class="successMsg">{{session('msg')}} </p>
@if($student)

<form>
     @csrf
     <table class="table formTable">
        <tr>
            <td colspan="1"> <img class="profilePic" src=" @if ($st->profile_pic)
             {{asset($st->profile_pic)}}
             @else 
             {{asset('images/dummy.png')}}
             @endif" alt="">
            </td>
            <td  style="vertical-align: middle" class="errorText">  {{ $errors->first('profile_pic')}}</td>
         </tr>
         <tr>
             <td class="labelT">Name:</td>
             <td style="font-weight: 700;">{{$st->name}}</td>
            </tr>
            <tr>
                <td class="labelT">Email:</td>
                <td style="font-weight: 700;">{{$st->email}}</td>
            </tr>
            <tr>
                <td class="labelT">Phone:</td>
                <td style="font-weight: 700;">{{$st->phone}}</td>
            </tr>
            <tr>
             <td class="labelT">Student ID:</td>
             <td colspan="">{{$st->student_id}}</td>
         </tr>
         <tr>
             <td class="labelT">Address:</td>
             <td>{{$st->address}}</td>
            </tr>
            <tr>
                <td class="labelT">Cgpa:</td>
                <td style="font-weight: 700;">{{$st->CGPA}}</td>
            </tr>
            <tr>
                <td class="labelT">Department:</td>
                <td style="font-weight: 700;">{{$std}}</td>
            </tr>
            <tr>
                <td class="labelT">Birth Date:</td>
                <td style="font-weight: 700;">{{$st->birthdate}}</td>
            </tr>
            <tr>
                <td class="labelT">Admission Date:</td>
                <td style="font-weight: 700;">{{$st->admission_date}}</td>
            </tr>
            <tr>
                <td class="labelT">Credits Completed:</td>
                <td style="font-weight: 700;">{{$st->credits_completed}}</td>
            </tr>
     </table>
  
 </form>

 <div class="buttonDiv">
     <a href="{{route('student.edit')}}">
		<button type="submit" name="submit" class="btn btn-success" style="margin:5px">EDIT</button></td></a>
    </div> 

 @else
    <h3 style="text-align: center;color:red" > Student ID Error!</h3>
 @endif

@endsection 