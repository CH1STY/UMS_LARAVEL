@extends('layout.adminDashboard')

@section('pageTitle')

View Courses
    
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
<input type="hidden" id="fetch_url" value="{{route('admin.course.fetch')}}">


@endsection

@section('container')

<h1 align="center">Courses</h1>
<p class="successMsg">{{session('msg')}} </p>
<div style="display: inline">
    <input style="width:95%; display:inline" type="text" name="search" id="search" class="form-control"  />
    <i class="fas fa-search"></i>
</div>
  
<div id="Course">
    <table class="table customTable">
        <thead>
            <th class="sorting" data-sorting_type="asc"  data-column_name="cname">Course Name <span id="cname_icon"></span> </th>
            <th class="sorting" data-sorting_type="asc"  data-column_name="csname">Subject Name <span id="csname_icon"></span> </th>
            <th class="sorting" data-sorting_type="asc"  data-column_name="cuname">University Name <span id="cuname_icon"></span> </th>
            <th class="sorting" data-sorting_type="asc"  data-column_name="cdname">Department Name <span id="cdname_icon"></span> </th>
            <th class="sorting" data-sorting_type="asc"  data-column_name="csemester">Semester <span id="csemester_icon"></span> </th>
            <th>Actions</th>
        </thead>
        <tbody>
           
            @include('admin.course.ViewCoursesFetch')
            
        </tbody>
       
    </table>
    <input type="hidden" name="hidden_page" id="hidden_page" value="1">
    <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="cname">
    <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="asc">



</div>


<script>

    function clear_icon()
    {
        $('#cname_icon').html('');
        $('#csname_icon').html('');
        $('#cuname_icon').html('');
        $('#cdname_icon').html('');
        $('#csemester_icon').html('');
    }
</script>

@include('admin.searchSortPagi')



@endsection
