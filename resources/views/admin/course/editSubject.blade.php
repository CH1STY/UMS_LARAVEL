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
        <td><h1>SUBJECT EDITING PAGE</h1></td>
        <td><a href="{{route('admin.subject.view')}}"><button class="btn btn-dark">Back</button></a></td>
    </tr>
</table>
<p class="successMsg">{{session('msg')}} </p>

@if($subject)

 <form action="" enctype="multipart/form-data" method="post">
     @csrf
     <table class="table formTable">
         <tr>
             <td class="labelT">Subject Name</td>
             <td><input type="text" name="name" id="" value="{{$subject->sname}}" max="5" min="1"></td>
             <td class="errorText">  {{ $errors->first('name')}}</td>
         </tr>
        <tr>
            <td class="labelT">Department Name</td>
            <td colspan="2">{{$subject->dname}}</td>
        </tr>
       
        <tr>
            <td class="labelT">Admin Name</td>
            <td colspan="2">{{$subject->adname}}</td>
        </tr>
        <tr>
            <td class="labelT">University</td>
            <td colspan="2">{{$subject->uname}}</td>
        </tr>
           
    </table>

   <div class="buttonDiv">
       <button class="btn btn-primary" type="submit">Update</button>
   </div> 
</form>

@else 

<h3 style="color:red" align="center">Course Id Error</h3>

@endif


@endsection