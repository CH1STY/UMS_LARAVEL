@extends('layout.studentDashboard')

@section('pageTitle')

Course Registration
    
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


<h1 align="center">Course Registration</h1>
<p class="successMsg">{{session('msg')}} </p>
 <form action="" method="post">
     @csrf
     <table class="table formTable">
     <tr>
             <td class="labelT">Course 01:</td>
             <td>
                <select class="form-select"  name="course1_id" id="">
                    <option value="0" selected>Select Course</option>
                    @foreach ($courseList as $cor)
                    <option value="{{$cor->course_id}}" @if(old('course_id')==$cor->course_id) selected @endif >{{$cor->name}}</option>  
                    @endforeach
                </select>
            
            </td>
             <td class="errorText">{{ $errors->first('course_id')}}</td>
         </tr>
         <tr>
             <td class="labelT">Course 02:</td>
             <td>
                <select class="form-select"  name="course2_id" id="">
                    <option value="0" selected>Select Course</option>
                    @foreach ($courseList as $cor)
                    <option value="{{$cor->course_id}}" @if(old('course_id')==$cor->course_id) selected @endif >{{$cor->name}}</option>  
                    @endforeach
                </select>
            
            </td>
             <td class="errorText">{{ $errors->first('course_id')}}</td>
         </tr>
         <tr>
             <td class="labelT">Course 03:</td>
             <td>
                <select class="form-select"  name="course3_id" id="">
                    <option value="0" selected>Select Course</option>
                    @foreach ($courseList as $cor)
                    <option value="{{$cor->course_id}}" @if(old('course_id')==$cor->course_id) selected @endif >{{$cor->name}}</option>  
                    @endforeach
                </select>
            
            </td>
             <td class="errorText">{{ $errors->first('course_id')}}</td>
         </tr>
         <tr>
             <td class="labelT">Course 04:</td>
             <td>
                <select class="form-select"  name="course4_id" id="">
                    <option value="0" selected>Select Course</option>
                    @foreach ($courseList as $cor)
                    <option value="{{$cor->course_id}}" @if(old('course_id')==$cor->course_id) selected @endif >{{$cor->name}}</option>  
                    @endforeach
                </select>
            
            </td>
             <td class="errorText">{{ $errors->first('course_id')}}</td>
         </tr>
    
     </table>

     <div class="buttonDiv btnMargin">
        <button class="btn btn-primary" type="submit">Apply</button>
    	</div>
 </form>
@endsection 