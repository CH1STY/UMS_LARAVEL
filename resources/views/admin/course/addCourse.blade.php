@extends('layout.adminDashboard')

@section('pageTitle')

Course Adding
    
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

<h1 align="center">Course Adding</h1>
<p class="successMsg">{{session('msg')}} </p>

<form action="" method="post">
    @csrf
    <table class="table formTable">
        <tr>
            <th>Name</th>
            <td><input type="text" name="name" id=""></td>
            <td class="errorText">{{$errors->first('name')}}</td>
        </tr>
        <tr>
            <td>Subject Code</td>
            <td>
                <select class ="form select" name="subject_code" id="">
                    <option value="">Please Select a Subject</option>
                    @foreach ($subjectList as $subject)
                    <option value="{{$subject->subject_code}}"  @if(old('subject_code')==$subject->subject_code) selected @endif >{{$subject->name}}</option>
                    @endforeach
                </select>
            </td>
            <td class="errorText">{{$errors->first('subject_code')}}</td>
        </tr>
        <tr>
            <td>Select Prerequisite</td>
            <td>
                <select class ="form select" name="prerequisite" id="">
                    <option value="">Please Select a Subject</option>
                    @foreach ($subjectList as $subject)
                    <option value="{{$subject->subject_code}}"  @if(old('prerequisite')==$subject->subject_code) selected @endif >{{$subject->name}}</option>
                    @endforeach
                </select>
            </td>
            <td class="errorText">{{$errors->first('prerequisite')}}</td>
        </tr>
        <tr>
            <td>Semester</td>
            <td>
                <select class ="form select" name="semester" id="">
                    <option value="">Please Select a Semester</option>
                    <option value="Spring" @if(old('semester')=="Spring" ) selected @endif>Spring</option>
                    <option value="Summer" @if(old('semester')=="Summer") selected @endif>Summer</option>
                    <option value="Fall" @if(old('semester')=="Fall")  selected @endif>Fall</option>
                    
                </select>
            </td>
            <td class="errorText">{{$errors->first('semester')}}</td>
        </tr>
        <tr>
            <td>Credits</td>
            <td>
                <select class ="form select" name="credits" id="">
                    <option value="">Select Credits</option>
                    @for($i=1;$i<=5;$i++)
                    
                    <option value="{{$i}}" @if($i==old('credits')) selected @endif>{{$i}}</option>
                    
                    @endfor
                    
                </select>
            </td>
            <td class="errorText">{{$errors->first('credits')}}</td>
        </tr>
    </table>
    <div class="buttonDiv">
        <button class="btn btn-primary" type="submit">ADD</button>
    </div> 
</form>

    
@endsection
