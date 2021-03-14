@extends('layout.adminDashboard')

@section('pageTitle')

Teacher Registration
    
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


<h1 align="center">Teacher Registration Page</h1>
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
         <tr>
             <td class="labelT">Date Of Birth:</td>
             <td><input class="inputF" type="date" name="birthdate" id="" value="{{old('birthdate')}}" ></td>
             <td class="errorText">{{ $errors->first('birthdate')}}</td>
         </tr>
         <tr>
             <td class="labelT">Salary:</td>
             <td><input class="inputF" type="number" name="salary" id="" value="{{old('salary')}}" ></td>
             <td class="errorText">{{ $errors->first('salary')}}</td>
         </tr>
         <tr>
             <td class="labelT">University:</td>
             <td>
                <select class="form-select"  name="university_id" id="">
                    <option value="0" selected>Select an University</option>
                    @foreach ($universityList as $univ)
                    <option value="{{$univ->university_id}}" @if(old('university_id')==$univ->university_id) selected @endif >{{$univ->name}}</option>  
                    @endforeach
                </select>
            
            </td>
             <td class="errorText">{{ $errors->first('university_id')}}</td>
         </tr>
    
     </table>

    <div class="buttonDiv btnMargin">
        <button class="btn btn-primary" type="submit">Register</button>
    </div> 
 </form>
@endsection 