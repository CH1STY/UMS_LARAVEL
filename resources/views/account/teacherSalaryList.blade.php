
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salary List</title>
</head>
<body>
    <table border="1">
    <tr>
        <td>Name:</td>
        <td>Id:</td>
        <td>Salary:</td>
        <td>Adress</td>
        <td>email:</td>
    </tr>
    <tr>
        <td>Rayhan</td>
        <td>Ac101</td>
        <td>30000</td>
        <td>Narayangonj</td>
        <td>bhuiyanrayhan606@gmail.com</td>
    </tr>
    <tr>
        <td>Rayhan</td>
        <td>Ac101</td>
        <td>30000</td>
        <td>Narayangonj</td>
        <td>bhuiyanrayhan606@gmail.com</td>
    </tr>
    
    
    </table>
</body>
</html>
@endsection



