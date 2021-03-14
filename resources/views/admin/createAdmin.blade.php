@extends('layout.adminDashboard')

@section('pageTitle')

Admin Dashboard
    
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


<h1 align="center">Admin Registration Page</h1>
<p class="successMsg">{{session('msg')}} </p>
 <form action="" method="post">
     @csrf
     <table class="table formTable">
         <tr>
             <td class="labelT">Name:</td>
             <td><input class="inputF" type="text" name="name" id="" value="{{old('name')}}"></td>
             <td class="errorText">  {{ $errors->first('name')}}</td>
         </tr>
         <tr>
             <td class="labelT">Username:</td>
             <td><input class="inputF" type="text" name="username" id="" value="{{old('username')}}"></td>
             <td class="errorText"> {{ $errors->first('username')}}</td>
         </tr>
         <tr>
             <td class="labelT">Phone:</td>
             <td><input class="inputF" type="text" name="phone" id="" value="{{old('phone')}}"></td>
             <td class="errorText"> {{ $errors->first('phone')}} </td>
         </tr>
         <tr>
             <td class="labelT">Email:</td>
             <td><input class="inputF" type="email" name="email" id="" value="{{old('email')}}"></td>
             <td class="errorText"> {{ $errors->first('email')}} </td>
         </tr>
         <tr>
             <td class="labelT">Password:</td>
             <td><input class="inputF" type="password" name="password" id=""></td>
             <td class="errorText"> {{ $errors->first('password')}} </td>
         </tr>
         <tr>
             <td class="labelT">Confirm Password:</td>
             <td><input class="inputF" type="password" name="password_confirmation" id=""></td>
             <td class="errorText">{{ $errors->first('password')}}</td>
         </tr>
         <tr>
             <td class="labelT">Address:</td>
             <td><input class="inputF" type="text" name="address" id="" value="{{old('address')}}" ></td>
             <td class="errorText">{{ $errors->first('address')}}</td>
         </tr>
    
     </table>

    <div class="buttonDiv">
        <button class="btn btn-primary" type="submit">Register</button>
    </div> 
 </form>
@endsection 