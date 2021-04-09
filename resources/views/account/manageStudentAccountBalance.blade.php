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
<h1>Hello This is Student Course fee</h1>

<form method="post" action="{{ url('/insertSalary') }}">
{{ csrf_field() }}
  <label for="name">Student Id:</label>
  <input type="text" id="" name="student_id"><br><br>
  <label for="courseFee">Balance:</label>
  <input type="number" id="" name="balance"><br><br>
  <input type="submit" value="Insert">
</form>
@endsection