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

<h1 align="center">Welcome To Admin Dashboard</h1>
<h5>Logged in as: {{$admin->username}}</h5>
<h5>ID: {{$admin->admin_id}}</h5>
<div style="">
   
    <!-- University table-------->
    <table class="table tableCustom" >
        <thead>
            <tr >
                <th colspan="5" style="font-weight:bold; font-size:16px; text-align: center;">Recently Added Universities</th>
            </tr>
            <tr>
                
                <th>Name</th>
                <th>University ID</th>
                <th>Address</th>
                <th>Admin ID</th>
                <th>Creation Time</th>
            </tr>
        </thead>
        <tbody>
           @foreach ($universityList as $ad)

           <tr>
               <td>{{$ad->name}}</td>
               <td>{{$ad->university_id}}</td>
               <td>{{$ad->address}}</td>
               <td>{{$ad->admin_id}}</td>
               <td>{{$ad->created_at}}</td>
           </tr>
               
           @endforeach
        </tbody>
        <tfoot>
            <tr><td style="text-align: center"  colspan="5"> <a href="{{route('admin.view.university')}}">View|Edit Univeristy</a> </td></tr>
        </tfoot>
    </table>
    <!-- admin table-------->
    <table class="table tableCustom" >
        <thead>
            <tr >
                <th colspan="5" style="font-weight:bold; font-size:16px; text-align: center;">Recently Added Admins</th>
            </tr>
            <tr>
                
                <th>User Name</th>
                <th>User ID</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Creation Time</th>
            </tr>
        </thead>
        <tbody>
           @foreach ($adminList as $ad)

           <tr>
               <td>{{$ad->username}}</td>
               <td>{{$ad->admin_id}}</td>
               <td>{{$ad->email}}</td>
               <td>{{$ad->phone}}</td>
               <td>{{$ad->created_at}}</td>
               
           </tr>
               
           @endforeach
        </tbody>
        <tfoot>
            <tr><td style="text-align: center"  colspan="5"> <a href="{{route('admin.view.admin')}}">View Full Admin List</a> </td></tr>
        </tfoot>
    </table>
    <!-- accounts table-------->
    
    <table class="table tableCustom" >
        <thead>
            <tr >
                <th colspan="5" style="font-weight:bold; font-size:16px; text-align: center;">Recently Added Accounts</th>
            </tr>
            <tr>
                <th>User Name</th>
                <th>User ID</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Creation Time</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($accountList as $ad)

           <tr>
               <td>{{$ad->username}}</td>
               <td>{{$ad->account_id}}</td>
               <td>{{$ad->email}}</td>
               <td>{{$ad->phone}}</td>
               <td>{{$ad->created_at}}</td>
               
           </tr>
               
           @endforeach
        </tbody>
        <tfoot>
            <tr><td style="text-align: center"  colspan="5"> <a href="{{route('admin.view.account')}}">View|Edit Full Account List</a> </td></tr>
        </tfoot>
    </table>
    
    <table class="table tableCustom" >
        <thead>
            <tr >
                <th colspan="5" style="font-weight:bold; font-size:16px; text-align: center;">Recently Added Teacher</th>
            </tr>
            <tr>
                <th>User Name</th>
                <th>User ID</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Creation Time</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($teacherList as $ad)

           <tr>
               <td>{{$ad->username}}</td>
               <td>{{$ad->teacher_id}}</td>
               <td>{{$ad->email}}</td>
               <td>{{$ad->phone}}</td>
               <td>{{$ad->created_at}}</td>
               
           </tr>
               
           @endforeach
        </tbody>
        <tfoot>
            <tr><td style="text-align: center"  colspan="5"> <a href="{{route('admin.view.teacher')}}">View|Edit Full Teacher List</a> </td></tr>
        </tfoot>
    </table>
    
    <table class="table tableCustom" >
        <thead>
            <tr >
                <th colspan="5" style="font-weight:bold; font-size:16px; text-align: center;">Recently Added Students</th>
            </tr>
            <tr>
                <th>User Name</th>
                <th>User ID</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Creation Time</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($studentList as $ad)

           <tr>
               <td>{{$ad->username}}</td>
               <td>{{$ad->student_id}}</td>
               <td>{{$ad->email}}</td>
               <td>{{$ad->phone}}</td>
               <td>{{$ad->created_at}}</td>
               
           </tr>
               
           @endforeach
        </tbody>
        <tfoot>
            <tr><td style="text-align: center"  colspan="5"> <a href="{{route('admin.view.student')}}">View|Edit Full Students List</a> </td></tr>
        </tfoot>
    </table>
</div>

@endsection 