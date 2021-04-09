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
       
           
    </table>

   <div class="buttonDiv">
       <button class="btn btn-primary" type="submit">Update</button>
   </div> 
</form>

@else 

<h3 style="color:red" align="center">Course Id Error</h3>

@endif


@endsection