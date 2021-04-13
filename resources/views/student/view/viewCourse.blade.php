@extends('layout.studentDashboard')

@section('pageTitle')

View Universities
    
@endsection



@section('profilePicSource')

    @if ($student->profile_pic)
    {{asset($student->profile_pic)}}
    @else 
    {{asset('images/dummy.png')}}
    @endif
    
@endsection

@section('username')

{{$student->name}}
    
@endsection

@section('extraCss')
<link rel="stylesheet" href="{{asset('css/admin/table.css')}}">



@endsection

@section('container')

    <h1 align="center">Course List</h1>
    <h6 align="center" style="color:green">{{session('msg')}}</h6>

    <table class="table tableCustom">
        <thead>
            <tr>
                

                <th class="sorting" data-sorting_type="asc"  data-column_name="name" >Name <span id="name_icon"></th>
                <th class="sorting" data-sorting_type="asc"  data-column_name="course_id" >Course Id <span id="university_id_icon"></th>
                <th class="sorting" data-sorting_type="asc"  data-column_name="prerequisite" >Pre-Requisite <span id="address_icon"></th>
                
            </tr>
        </thead>
        <tbody>
            @include('student.view.fetchCourse')
        </tbody>
               
        
    </table>
    

@endsection 