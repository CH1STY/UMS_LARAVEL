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
<h1>Hello This is Insert course fee Page</h1>

<tbody>

@foreach($all_student_info as $v_student)
<tr>
<td>{{$v_student->student_id}}</td>
</tr>



@endforeach
</tbody>
@endsection