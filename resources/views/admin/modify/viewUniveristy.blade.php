@extends('layout.adminDashboard')

@section('pageTitle')

View Universities
    
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
<input type="hidden" id="fetch_url" value="{{route('admin.fetch.university')}}">
<script>
    function check(){
       if(confirm("Are You Sure? All The Information Related to this University Will Be Deleted?"))
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

    <h1 align="center">University List</h1>
    <h6 align="center" style="color:green">{{session('msg')}}</h6>
    <div style="display: inline">
        <input style="width:95%; display:inline" type="text" name="search" id="search" class="form-control"  />
        <i class="fas fa-search"></i>
    </div>
    <table class="table tableCustom">
        <thead>
            <tr>
                

                <th class="sorting" data-sorting_type="asc"  data-column_name="name" >Name <span id="name_icon"></th>
                <th class="sorting" data-sorting_type="asc"  data-column_name="university_id" >Univeristy Id <span id="university_id_icon"></th>
                <th class="sorting" data-sorting_type="asc"  data-column_name="address" >Address <span id="address_icon"></th>
                <th class="sorting" data-sorting_type="asc"  data-column_name="admin_id" >Admin Id <span id="admin_id_icon"></th>
                <th class="sorting" data-sorting_type="asc"  data-column_name="updated_at" >Last Updated <span id="updated_at_icon"></th>
                
                
                <th style="text-align: center" colspan="2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @include('admin.modify.fetchUniversity')
        </tbody>
       
               
        
    </table>

    <input type="hidden" name="hidden_page" id="hidden_page" value="1">
    <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="name">
    <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="asc">

    <script>

        function clear_icon()
        {
            $('#name_icon').html('');
            $('#university_id_icon').html('');
            $('#address_icon').html('');
            $('#admin_id_icon').html('');
            $('#updated_at_icon').html('');
        }
    </script>
    
    @include('admin.searchSortPagi')
    

@endsection 