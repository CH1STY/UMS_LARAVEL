@extends('layout.adminDashboard')

@section('pageTitle')

Resigning Management
    
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
<input type="hidden" id="fetch_url" value="{{route('admin.resign.fetch')}}">


@endsection

@section('container')

<h1 align="center">Employee Resigning Applications</h1>
<p class="successMsg">{{session('msg')}} </p>
<div style="display: inline">
    <input style="width:95%; display:inline" type="text" name="search" id="search" class="form-control"  />
    <i class="fas fa-search"></i>
</div>


    <table class="table formTable">
        <thead>
                <th class="sorting" data-sorting_type="asc"  data-column_name="empid" >Employee ID <span id="empid_icon"></th>
                <th class="sorting" data-sorting_type="asc"  data-column_name="empname" >Employee Name <span id="empname_icon"></th>
                <th style="display:flex; justify-content:center;" colspan="2">Actions</th>
           
        </thead>
        <tbody>
            @include('admin.resign.fetch')
        </tbody>
    </table>



<input type="hidden" name="hidden_page" id="hidden_page" value="1">
    <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="empid">
    <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="asc">

    <script>

        function clear_icon()
        {
            $('#empid_icon').html('');
            $('#empname_icon').html('');
        }
    </script>
    
    @include('admin.searchSortPagi')

@endsection
