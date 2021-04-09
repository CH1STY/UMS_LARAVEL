@extends('layout.accountDashboard')
@section('pageTitle')

Accounts Dashboard
    
@endsection

@section('profilePicSource')

    @if ($account->profile_pic)
    {{asset($account->profile_pic)}}
    @else 
    {{asset('images/dummy.png')}}
    @endif
    
@endsection

@section('username')

{{$account->name}}
    
@endsection

@section('container')
<h1>Hello This is Teachers Account Balance Management</h1>
<br>


@endsection