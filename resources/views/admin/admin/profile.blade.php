@extends('layout.adminDashboard')

@section('pageTitle')

Admin Details
    
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
        <td><h1>ADMIN PROFILE</h1></td>
        <td><a href="{{route('admin')}}"><button class="btn btn-dark">Back</button></a></td>
    </tr>
</table>
<p class="successMsg">{{session('msg')}} </p>
@if($admin)

<form action="" enctype="multipart/form-data" method="post">
     @csrf
     <table class="table formTable">
        <tr>
            <td colspan="1"> <img class="profilePic" src=" @if ($ad->profile_pic)
             {{asset($ad->profile_pic)}}
             @else 
             {{asset('images/dummy.png')}}
             @endif" alt="">
             <input type="file" name="profile_pic" id="">
            </td>
            <td  style="vertical-align: middle" class="errorText">  {{ $errors->first('profile_pic')}}</td>
         </tr>
         <tr>
             <td class="labelT">Name:</td>
             <td style="font-weight: 700;">{{$ad->name}}</td>
            </tr>
            <tr>
                <td class="labelT">Phone:</td>
                <td style="font-weight: 700;">{{$ad->phone}}</td>
            </tr>
            <tr>
             <td class="labelT">Admin ID:</td>
             <td colspan="">{{$ad->admin_id}}</td>
         </tr>
         <tr>
             <td class="labelT">Address:</td>
             <td>{{$ad->address}}</td>
            </tr>
            
            <tr>
               <td class="labelT">Creation Date:</td>
               <td colspan="">{{date('l jS \of F Y h:i:s A', strtotime($ad->created_at))}}</td>
           </tr>
     </table>

     <div class="buttonDiv">
        <button class="btn btn-primary" type="submit">Update</button>
    </div> 
  
 </form>

 @else
    <h3 style="text-align: center;color:red" > Admin ID Error!</h3>
 @endif

@endsection 