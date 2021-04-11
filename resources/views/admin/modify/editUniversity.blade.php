@extends('layout.adminDashboard')

@section('pageTitle')

Edit University

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
        <td><h1>UNIVERSITY EDITING PAGE</h1></td>
        <td><a href="{{route('admin.view.university')}}"><button class="btn btn-dark">Back</button></a></td>
    </tr>
</table>
<p class="successMsg">{{session('msg')}} </p>

@if($university)

 <form action="" enctype="multipart/form-data" method="post">
     @csrf
     <table class="table formTable">
         <tr>
            <td colspan="2"> <img class="profilePic" src=" @if ($university->profile_pic)
             {{asset($university->profile_pic)}}
             @else
             {{asset('images/dummy.png')}}
             @endif" alt="">
             <input type="file" name="profile_pic" id="">
            </td>
            <td  style="vertical-align: middle" class="errorText">  {{ $errors->first('profile_pic')}}</td>
         </tr>
         <tr>
             <td class="labelT">Name:</td>
             <td><input class="inputF" type="text" name="name" id="" value="{{$university->name}}"></td>
             <td class="errorText">  {{ $errors->first('name')}}</td>
         </tr>
         <tr>
             <td class="labelT">University ID:</td>
             <td colspan="2">{{$university->university_id}}</td>
         </tr>
         <tr>
             <td class="labelT">Admin ID:</td>
             <td colspan="2">{{$university->admin_id}}</td>
         </tr>
         <tr>
             <td class="labelT">Address:</td>
             <td><input class="inputF" type="text" name="address" id="" value="{{$university->address}}" ></td>
             <td class="errorText">{{ $errors->first('address')}}</td>
            </tr>

            <tr>
               <td class="labelT">Creation Date:</td>
               <td colspan="2">{{date('l jS \of F Y h:i:s A', strtotime($university->created_at))}}</td>

           </tr>
           
         
    </table>

   <div class="buttonDiv">
       <button class="btn btn-primary" type="submit">Update</button>
   </div> 
</form>

@else 

<h3 style="color:red" align="center">University Id Error</h3>

@endif

@endsection 

