@extends('layout.adminDashboard')

@section('pageTitle')

Subject Adding
    
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

<h1 align="center">Subject Adding</h1>
<p class="successMsg">{{session('msg')}} </p>

<form action="" method="post">
    @csrf
    <table class="table formTable">
        <tr>
            <th>Name</th>
            <td><input type="text" name="name" id="" value="{{old('name')}}"></td>
            <td class="errorText">{{$errors->first('name')}}</td>
        </tr>
        <tr>
            <td>University</td>
            <td>
                <select class ="form select" name="university_id" id="">
                    <option value="">Please Select an University</option>
                    @foreach ($universityList as $university)
                    <option value="{{$university->university_id}}"   @if(old('university_id')==$university->university_id) selected @endif>{{$university->name}}</option>
                    @endforeach
                </select>
                <td class="errorText">{{$errors->first('university_id')}}</td>
            </td>
        </tr>
        <tr>
            <td>Department</td>
            <td>
                <select class ="form select" name="department_id" id="">
                    <option value="">Please Select a Department</option>
                    @foreach ($departmentList as $department)
                    <option value="{{$department->department_id}}" @if(old('department_id')==$department->department_id) selected @endif >{{$department->name}}</option>
                    @endforeach
                </select>
            </td>
            <td class="errorText">{{$errors->first('department_id')}}</td>
        </tr>
    </table>
    <div class="buttonDiv">
        <button class="btn btn-primary" type="submit">ADD</button>
    </div> 
</form>

    
@endsection
