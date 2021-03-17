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


@endsection

@section('container')

    <h1 align="center">Admin List</h1>
    <h6 align="center" style="color:green">{{session('msg')}}</h6>
    <table class="table tableCustom">
        <thead>
            <tr>
                
                @php 
                if($sortType=='asc') {$sortType='desc';} 
                else 
                {$sortType='asc';}   
                @endphp

                <th><a href="{{route('admin.view.admin',['sort'=>'name','sortType'=>$sortType,])}}">Name @if(request('sort')=='name') @if(request('sortType')=='asc') &uarr;  @elseif(request('sortType')=='desc') &darr; @endif  @endif</a></th>
                <th><a href="{{route('admin.view.admin',['sort'=>'admin_id','sortType'=>$sortType,])}}">Admin Id @if(request('sort')=='admin_id') @if(request('sortType')=='asc') &uarr;  @elseif(request('sortType')=='desc') &darr; @endif  @endif</a></th>
                <th><a href="{{route('admin.view.admin',['sort'=>'email','sortType'=>$sortType,])}}">email @if(request('sort')=='email') @if(request('sortType')=='asc') &uarr;  @elseif(request('sortType')=='desc') &darr; @endif  @endif</a></th>
                <th><a href="{{route('admin.view.admin',['sort'=>'phone','sortType'=>$sortType,])}}">phone  @if(request('sort')=='phone') @if(request('sortType')=='asc') &uarr;  @elseif(request('sortType')=='desc') &darr; @endif  @endif</a></th>
                <th><a href="{{route('admin.view.admin',['sort'=>'created_at','sortType'=>$sortType,])}}">Creation Date @if(request('sort')=='created_at') @if(request('sortType')=='asc') &uarr;  @elseif(request('sortType')=='desc') &darr; @endif  @endif</a></th>
                
               
                <th style="text-align: center" colspan="">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($adminList as $ad)

            <tr>
                <td>{{$ad->name}}</td>
                <td>{{$ad->admin_id}}</td>
                <td>{{$ad->email}}</td>
                <td>{{$ad->phone}}</td>
                <td>{{$ad->created_at}}</td>
                <td colspan="" align="center"><a href="{{route('admin.details.admin',['ad_id'=> $ad->id ,])}}"><button class="btn btn-info">Details</button></a></td>
            </tr>
                
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6"><div style="display:flex;justify-content:center;" >{{$adminList->links()}}</div></td>
            </tr>
        </tfoot>
    </table>

@endsection 