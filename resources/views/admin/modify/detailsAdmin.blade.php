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
        <td><h1>ADMIN DEATAILS</h1></td>
        <td><a href="{{route('admin.view.admin')}}"><button class="btn btn-dark">Back</button></a></td>
    </tr>
</table>
<p class="successMsg">{{session('msg')}} </p>
@if($ad)

<form action="" enctype="multipart/form-data" method="post">
     @csrf
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
             <td class="labelT">Name:</td>
             <td style="font-weight: 700;">{{$ad->name}}</td>
         </tr>
         <tr>
             <td class="labelT">University Added:</td>
             <td style="font-weight: 700;">{{$totalUniversity}}</td>
         </tr>
         <tr>
             <td class="labelT">Student Added:</td>
             <td style="font-weight: 700;">{{$totalStudent}}</td>
         </tr>
         <tr>
             <td class="labelT">Employee Added:</td>
             <td style="font-weight: 700;">{{$totalEmployees}}</td>
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

  
 </form>

 @else
    <h3 style="text-align: center;color:red" > Admin ID Error!</h3>
 @endif

@endsection 