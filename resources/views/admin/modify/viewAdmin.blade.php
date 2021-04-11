@extends('layout.adminDashboard')

@section('pageTitle')

View Admins
    
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
<input type="hidden" id="fetch_url" value="{{route('admin.fetch.admin')}}">


@endsection

@section('container')

    <h1 align="center">Admin List</h1>
    <h6 align="center" style="color:green">{{session('msg')}}</h6>
    <div style="display: inline">
        <input style="width:95%; display:inline" type="text" name="search" id="search" class="form-control"  />
        <i class="fas fa-search"></i>
    </div>
    <table class="table tableCustom">
        <thead>
            <tr>
                
              

                <th class="sorting" data-sorting_type="asc"  data-column_name="name">Name <span id="name_icon"></th> 
                <th class="sorting" data-sorting_type="asc"  data-column_name="admin_id">Admin Id <span id="admin_id_icon"> </th>
                <th class="sorting" data-sorting_type="asc"  data-column_name="email">Email  <span id="email_icon"> </th>
                <th class="sorting" data-sorting_type="asc"  data-column_name="phone">Phone  <span id="phone_icon"></th>
                <th class="sorting" data-sorting_type="asc"  data-column_name="created_at">Creation Date <span id="created_at_icon"> </th>
                
               
                <th style="text-align: center" colspan="">Actions</th>
            </tr>
        </thead>
        <tbody>
            @include('admin.modify.fetchAdmin')
        </tbody>
    </table>
    <input type="hidden" name="hidden_page" id="hidden_page" value="1">
    <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="name">
    <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="asc">


    <script>

        function clear_icon()
        {
            $('#name_icon').html('');
            $('#admin_id_icon').html('');
            $('#email_icon').html('');
            $('#phone_icon').html('');
            $('#created_at_icon').html('');
        }
    </script>
    
    @include('admin.searchSortPagi')
    


@endsection 