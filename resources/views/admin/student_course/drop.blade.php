@extends('layout.adminDashboard')

@section('pageTitle')

Dropping Student From Course
    
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
<link rel="stylesheet" href="{{asset('vendor/select2/select2.min.css')}}">
<style>
    body{
        color:green;
    }
</style>
<script src="{{asset('vendor/select2/select2.min.js')}}"></script>

@endsection

@section('container')
<h1 align="center">Dropping Student From Course</h1>
<p class="successMsg">{{session('msg')}} </p>
<form action="" method="post">
    @csrf

    <table class="table formTable">
        <tr>
            <td class="labelT">Select Student</td>
            <td>
                <select style="widht:200px;" name="student_id" id="student_box">
                    <option value="" selected>Please Select a Student ID....</option>
                    @foreach ($students as $student)

                    <option  value="{{$student->id}}">{{$student->student_id}}-{{$student->name}}</option>
                        
                    @endforeach
                </select>
            </td>
            <td class="errorText">{{$errors->first('student_id')}}</td>
        </tr>
        <tr>
            <td class="labelT">Course</td>
            <td>
                <select style="widht:200px;" name="student_course_id" id="course_box">
                    <option value="">Please Select a Course ID....</option>
                </select>
            </td>
            <td class="errorText">{{$errors->first('student_course_id')}}</td>
        </tr>
        <tr></tr>
    </table>

    <div class="buttonDiv">
        <button class="btn btn-danger" type="submit">DROP</button>
    </div> 
</form>

<script>

$(document).ready(function() {
    $('#student_box').select2();
    $('#course_box').select2();

    function updateCourseList()
    {

        student_id = $('#student_box').val();

        $.ajax({
                   
                   url: "{{route('admin.student.course.fetch.drop')}}"+"?student_id="+student_id,
                   success:function(data)
                   {
                        $('#course_box').html('');
                        $('#course_box').html(data);
                   }
               
        });
        
    }

    $("#student_box").change(function(){
        updateCourseList();
    });


});
</script>
@endsection