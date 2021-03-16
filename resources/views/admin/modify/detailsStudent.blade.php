@extends('layout.adminDashboard')

@section('pageTitle')

Teacher Details
    
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
        <td><h1>Student Details</h1></td>
        <td><a href="{{route('admin.view.student')}}"><button class="btn btn-dark">Back</button></a></td>
    </tr>
</table>
<p class="successMsg">{{session('msg')}} </p>
@if($ad)


     <table class="table formTable">
         <tr>
            <td colspan="2">
                <div style="display: flex;justify-content:center;"> <img class="profilePic" src=" @if ($ad->profile_pic)
                    {{asset($ad->profile_pic)}}
                    @else 
                    {{asset('images/dummy.png')}}
                    @endif" alt="">
                </div>
            </td>
         </tr>
         <tr>
             <td class="labelT">Student ID:</td>
             <td style="font-weight: 700;">{{$ad->student_id}}</td>
         </tr>
         <tr>
             <td class="labelT">Name:</td>
             <td style="font-weight: 700;">{{$ad->name}}</td>
         </tr>
         <tr>
             <td class="labelT">Email:</td>
             <td colspan="">{{$ad->email}}</td>
         </tr>
         <tr>
             <td class="labelT">Phone:</td>
             <td colspan="">{{$ad->phone}}</td>
         </tr>
         <tr>
             <td class="labelT">Address:</td>
             <td colspan="">{{$ad->address}}</td>
         </tr>
         <tr>
             <td class="labelT">Username</td>
             <td colspan="">{{$ad->username}}</td>
         </tr>
         <tr>
             <td class="labelT">CGPA</td>
             <td colspan="">{{floatval($ad->CGPA)}}</td>
         </tr>
         <tr>
             <td class="labelT">Credits Completed</td>
             <td colspan="">{{$ad->credits_completed}}</td>
         </tr>
         <tr>
             <td class="labelT">Status</td>
             <td colspan="">{{$ad->status}}</td>
         </tr>
         <tr>
             <td class="labelT">Admin ID:</td>
             <td colspan="">{{$ad->admin_id}}</td>
         </tr>
         <tr>
             <td class="labelT">University ID:</td>
             <td colspan="">{{$ad->university_id}}</td>
         </tr>
         <tr>
             <td class="labelT">Address:</td>
             <td>{{$ad->address}}</td>
            </tr>
            
            <tr>
               <td class="labelT">Date Of Birth:</td>
               <td colspan="">{{date('l jS \of F Y', strtotime($ad->birthdate))}}</td>
           </tr>
            <tr>
               <td class="labelT">Creation Date:</td>
               <td colspan="">{{date('l jS \of F Y h:i:s A', strtotime($ad->created_at))}}</td>
           </tr>
     </table>


 <div class="buttonDiv">
    <a href="{{route('admin.edit.account',['ac_id'=>$ad->id,])}}"><button align="center" class="btn btn-success">Edit</button></a>
</div>

 @else
    <h3 style="text-align: center;color:red" > Student ID Error!</h3>
 @endif

@endsection 