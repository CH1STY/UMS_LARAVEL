@extends('layout.adminDashboard')

@section('pageTitle')

View Notice
    
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
<input type="hidden" id="fetch_url" value="{{route('admin.notice.fetch')}}">


<script>
    function deleteF()
    {
        if(confirm('Are You Sure You Wants To Delete this notice?'))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
</script>

@endsection

@section('container')
    
<h1 align="center">Notice List</h1>
<h6 align="center" style="color:green">{{session('msg')}}</h6>
<div style="display: inline">
    <input style="width:95%; display:inline" type="text" name="search" id="search" class="form-control"  />
    <i class="fas fa-search"></i>
</div>
<table class="table tableCustom">
    <thead>
        <tr>
            
          
            <th class="sorting" data-sorting_type="asc"  data-column_name="notice_id" >Notice Id  <span id="notice_id_icon"> </th>
            <th class="sorting" data-sorting_type="asc"  data-column_name="details" >Details  <span id="details_icon"> </th>
            <th class="sorting" data-sorting_type="asc"  data-column_name="admin_id" >Admin ID  <span id="admin_id_icon"> </th> 
            <th class="sorting" data-sorting_type="asc"  data-column_name="created_at" >Date <span id="created_at_icon"> </th>
            
           
            <th style="text-align: center" colspan="">Actions</th>
        </tr>
    </thead>
    <tbody>
       @include('admin.notice.fetchNotices')
    </tbody>
    
    <script>

        function clear_icon()
        {
            $('#notice_id_icon').html('');
            $('#details_icon').html('');
            $('#admin_id_icon').html('');
            $('#date_icon').html('');
        }
    </script>
    
    @include('admin.searchSortPagi')
   
</table>
   
    
@endsection