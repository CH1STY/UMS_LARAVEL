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
<table class="table tableCustom">
    <thead>
        <tr>
            
            @php 
            if($sortType=='asc') {$sortType='desc';} 
            else 
            {$sortType='asc';}   
            @endphp

            <th><a href="{{route('admin.notice.view',['sort'=>'notice_id','sortType'=>$sortType,])}}">Notice Id @if(request('sort')=='notice_id') @if(request('sortType')=='asc') &uarr;  @elseif(request('sortType')=='desc') &darr; @endif  @endif</a></th>
            <th><a href="{{route('admin.notice.view',['sort'=>'details','sortType'=>$sortType,])}}">Details @if(request('sort')=='details') @if(request('sortType')=='asc') &uarr;  @elseif(request('sortType')=='desc') &darr; @endif  @endif</a></th>
            <th><a href="{{route('admin.notice.view',['sort'=>'admin_id','sortType'=>$sortType,])}}">Admin ID  @if(request('sort')=='admin_id') @if(request('sortType')=='asc') &uarr;  @elseif(request('sortType')=='desc') &darr; @endif  @endif</a></th>
            <th><a href="{{route('admin.notice.view',['sort'=>'created_at','sortType'=>$sortType,])}}">Date @if(request('sort')=='created_at') @if(request('sortType')=='asc') &uarr;  @elseif(request('sortType')=='desc') &darr; @endif  @endif</a></th>
            
           
            <th style="text-align: center" colspan="">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($noticeList as $ad)

        <tr>
            <td>{{$ad->notice_id}}</td>
            <td>{{$ad->details}}</td>
            <td>{{$ad->admin_id}}</td>
            <td>{{$ad->created_at}}</td>
            <td colspan="" align="center"><a onclick="return deleteF()" href="{{route('admin.notice.delete',['notice_id'=> $ad->id ,])}}"><button class="btn btn-danger">Delete</button></a></td>
        </tr>
            
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="5"><div style="display:flex;justify-content:center;" >{{$noticeList->links()}}</div></td>
        </tr>
    </tfoot>
</table>
   
    
@endsection