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
    <table class="table tableCustom">
        <thead>
            <tr>
                
                @php 
                if($sortType=='asc') {$sortType='desc';} 
                else 
                {$sortType='asc';}   
                @endphp

                <th><a href="{{route('admin.view.university',['sort'=>'name','sortType'=>$sortType,])}}">Name @if(request('sort')=='name') @if(request('sortType')=='asc') &uarr;  @elseif(request('sortType')=='desc') &darr; @endif  @endif</a></th>
                <th><a href="{{route('admin.view.university',['sort'=>'university_id','sortType'=>$sortType,])}}">Univeristy Id @if(request('sort')=='university_id') @if(request('sortType')=='asc') &uarr;  @elseif(request('sortType')=='desc') &darr; @endif  @endif</a></th>
                <th><a href="{{route('admin.view.university',['sort'=>'address','sortType'=>$sortType,])}}">Address @if(request('sort')=='address') @if(request('sortType')=='asc') &uarr;  @elseif(request('sortType')=='desc') &darr; @endif  @endif</a></th>
                <th><a href="{{route('admin.view.university',['sort'=>'admin_id','sortType'=>$sortType,])}}">Admin Id @if(request('sort')=='admin_id') @if(request('sortType')=='asc') &uarr;  @elseif(request('sortType')=='desc') &darr; @endif  @endif</a></th>
                <th><a href="{{route('admin.view.university',['sort'=>'created_at','sortType'=>$sortType,])}}">Creation Date @if(request('sort')=='created_at') @if(request('sortType')=='asc') &uarr;  @elseif(request('sortType')=='desc') &darr; @endif  @endif</a></th>
                
               
                <th style="text-align: center" colspan="2">Actions</th>
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
                <td><a href="{{route('admin.edit.university',['univ_id'=>$ad->id,])}}"><button class="btn btn-primary">Edit</button></a></td>
                <td><button class="btn btn-info">Details</button></td>
            </tr>
                
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="8"><div style="display:flex;justify-content:center;" >{{$universityList->links()}}</div></td>
            </tr>
        </tfoot>
    </table>

@endsection 