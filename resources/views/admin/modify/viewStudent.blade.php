@extends('layout.adminDashboard')

@section('pageTitle')

View Student
    
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

    <h1 align="center">Student List</h1>
    <h6 align="center" style="color:green">{{session('msg')}}</h6>
    <table class="table tableCustom">
        <thead>
            <tr>
                
                @php 
                if($sortType=='asc') {$sortType='desc';} 
                else 
                {$sortType='asc';}   
                @endphp

                <th><a href="{{route('admin.view.student',['sort'=>'name','sortType'=>$sortType,])}}">Name @if(request('sort')=='name') @if(request('sortType')=='asc') &uarr;  @elseif(request('sortType')=='desc') &darr; @endif  @endif</a></th>
                <th><a href="{{route('admin.view.student',['sort'=>'email','sortType'=>$sortType,])}}">email @if(request('sort')=='email') @if(request('sortType')=='asc') &uarr;  @elseif(request('sortType')=='desc') &darr; @endif  @endif</a></th>
                <th><a href="{{route('admin.view.student',['sort'=>'phone','sortType'=>$sortType,])}}">Phone  @if(request('sort')=='phone') @if(request('sortType')=='asc') &uarr;  @elseif(request('sortType')=='desc') &darr; @endif  @endif</a></th>
                <th><a href="{{route('admin.view.student',['sort'=>'status','sortType'=>$sortType,])}}">Status  @if(request('sort')=='status') @if(request('sortType')=='asc') &uarr;  @elseif(request('sortType')=='desc') &darr; @endif  @endif</a></th>
                <th><a href="{{route('admin.view.student',['sort'=>'university_id','sortType'=>$sortType,])}}">University Id @if(request('sort')=='university_id') @if(request('sortType')=='asc') &uarr;  @elseif(request('sortType')=='desc') &darr; @endif  @endif</a></th>
                <th><a href="{{route('admin.view.student',['sort'=>'admin_id','sortType'=>$sortType,])}}">Admin Id @if(request('sort')=='admin_id') @if(request('sortType')=='asc') &uarr;  @elseif(request('sortType')=='desc') &darr; @endif  @endif</a></th>
                <th><a href="{{route('admin.view.student',['sort'=>'updated_at','sortType'=>$sortType,])}}">Last Updated @if(request('sort')=='updated_at') @if(request('sortType')=='asc') &uarr;  @elseif(request('sortType')=='desc') &darr; @endif  @endif</a></th>
                
               
                <th style="text-align: center" colspan="2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($studentList as $ad)

            <tr>
                <td>{{$ad->name}}</td>
                <td>{{$ad->email}}</td>
                <td>{{$ad->phone}}</td>
                <td>{{$ad->status}}</td>
                <td>{{$ad->university_id}}</td>
                <td>{{$ad->admin_id}}</td>
                <td>{{$ad->created_at}}</td>
                <td colspan="" align="center"><a href="{{route('admin.edit.student',['ad_id'=> $ad->id ,])}}"><button class="btn btn-primary">Edit</button></a></td>
                <td colspan="" align="center"><a href="{{route('admin.details.student',['ad_id'=> $ad->id ,])}}"><button class="btn btn-info">Details</button></a></td>
            </tr>
                
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="9"><div style="display:flex;justify-content:center;" >{{$studentList->links()}}</div></td>
            </tr>
        </tfoot>
    </table>

@endsection 