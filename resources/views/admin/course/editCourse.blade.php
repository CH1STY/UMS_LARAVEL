@extends('layout.adminDashboard')

@section('pageTitle')

Course and Subjects
    
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
<link rel="stylesheet" href="{{asset('css/admin/tab.css')}}">



@endsection

@section('container')


<table style="width:100%">
    <tr>
        <td><h1>COURSE EDITING PAGE</h1></td>
        <td><a href="{{route('admin.course.view')}}"><button class="btn btn-dark">Back</button></a></td>
    </tr>
</table>
<p class="successMsg">{{session('msg')}} </p>

@if($course)

 <form action="" enctype="multipart/form-data" method="post">
     @csrf
     <table class="table formTable">
        <tr>
            <td class="labelT">Course Name</td>
            <td><input type="text" name="name" id="" value="{{$course->cname}}"></td>
            <td class="errorText">  {{ $errors->first('name')}}</td>
        </tr>
        <tr>
            <td class="labelT">Department Name</td>
            <td colspan="2">{{$course->dname}}</td>
        </tr>
        <tr>
            <td class="labelT">Subject Name</td>
            <td>
                <select name="subject_code" id="">
                    <option value="">Please Select a Subject</option>
                    @foreach ($subjects as $subject)
                        <option value="{{$subject->subject_code}}" @if($subject->subject_code==$course->cscode) selected @endif >{{$subject->name}}</option>
                        
                    @endforeach
                </select>
            </td>
            <td class="errorText">  {{ $errors->first('subject_code')}}</td>
        </tr>
        <tr>
            <td class="labelT">Prerequisite</td>
            <td>
                <select name="prerequisite" id="">
                    <option value="">Please Select a Prerequisite}</option>
                    @foreach ($subjectAll as $subject)
                        <option value="{{$subject->subject_code}}" @if($subject->subject_code==$course->prcode) selected @endif >{{$subject->name}}</option>
                        
                    @endforeach
                </select>
            </td>
            <td class="errorText">  {{ $errors->first('prerequisite')}}</td>
        </tr>
        <tr>
            <td class="labelT">Admin Name</td>
            <td colspan="2">{{$course->adname}}</td>
        </tr>
        <tr>
            <td class="labelT">Department</td>
            <td colspan="2">{{$course->dname}}</td>
        </tr>
        <tr>
            <td class="labelT">University</td>
            <td colspan="2">{{$course->uname}}</td>
        </tr>
        <tr>
            <td class="labelT">Credits</td>
            <td><input type="number" name="credits" id="" value="{{$course->credits}}" max="5" min="1"></td>
            <td class="errorText">  {{ $errors->first('credits')}}</td>
        </tr>
        <tr>
            <td class="labelT">Semester</td>
            <td colspan="2">{{$course->semester}}</td>
        </tr>
           
    </table>

   <div class="buttonDiv">
       <button class="btn btn-primary" type="submit">Update</button>
   </div> 
</form>

@else 

<h3 style="color:red" align="center">Course Id Error</h3>

@endif


@endsection