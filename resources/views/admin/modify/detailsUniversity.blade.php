@extends('layout.adminDashboard')

@section('pageTitle')

University Details
    
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
        <td><h1>UNIVERSITY DEATAILS</h1></td>
        <td><a href="{{route('admin.view.university')}}"><button class="btn btn-dark">Back</button></a></td>
    </tr>
</table>
<p class="successMsg">{{session('msg')}} </p>
@if($university)


     <table class="table formTable">
         <tr>
            <td colspan="2">
                <div style="display: flex;justify-content:center;"> <img class="profilePic" src=" @if ($university->profile_pic)
                    {{asset($university->profile_pic)}}
                    @else 
                    {{asset('images/dummy.png')}}
                    @endif" alt="">
                </div>
            </td>
         </tr>
         <tr>
             <td class="labelT">Name:</td>
             <td style="font-weight: 700;">{{$university->name}}</td>
         </tr>
         <tr>
             <td class="labelT">Total Employees:</td>
             <td>{{$totalEmployees}}</td>
         </tr>
         <tr>
             <td class="labelT">Total Students</td>
             <td>{{$totalStudent}}</td>
         </tr>
         <tr>
             <td class="labelT">Total Departments</td>
             <td>{{$totalDepartment}}</td>
         </tr>
         <tr>
             <td class="labelT">Total Courses</td>
             <td>{{$totalCourses}}</td>
         </tr>
         <tr>
             <td class="labelT">University ID:</td>
             <td colspan="">{{$university->university_id}}</td>
         </tr>
         <tr>
             <td class="labelT">Admin ID:</td>
             <td colspan="">{{$university->admin_id}}</td>
         </tr>
         <tr>
             <td class="labelT">Address:</td>
             <td>{{$university->address}}</td>
            </tr>
            
            <tr>
               <td class="labelT">Creation Date:</td>
               <td colspan="">{{date('l jS \of F Y h:i:s A', strtotime($university->created_at))}}</td>
           </tr>
     </table>

  <div class="buttonDiv">
      <a href="{{route('admin.edit.university',['univ_id'=>$university->id,])}}"><button align="center" class="btn btn-success">Edit</button></a>
  </div>

 @else
    <h3 style="text-align: center;color:red" > University ID Error!</h3>
 @endif

@endsection 