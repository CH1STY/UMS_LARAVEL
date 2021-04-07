@extends('layout.adminDashboard')

@section('pageTitle')

Notice Adding
    
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
    
    @if(session('postedData'))
       
        <div align="center"> <h1>Notice Posted</h1> {!! session('postedData') !!}</div>

        <div class="buttonDiv">
            <button onClick="window.location.reload();" class="btn btn-primary" type="submit">POST ANOTHER NOTICE</button>
        </div> 
    @else
    <h1 align="center">Notice Adding</h1>
    <form action="" method="post">
        @csrf
        <table class="table customTable">
            <tr>
                <th>Notice Details You May Add HTML and CSS FOR Text Formating</th>
            </tr>
            <tr>
                <td><textarea style="padding: 10px; resize:none;" name="details" id="" cols="120" rows="10"></textarea></td>
            </tr>
            <tr>
                <td align="center"><span style="color:red; text-align:center; font-weight:900">{{$errors->first('details')}}</span></td>
            </tr>
        </table>
        <div class="buttonDiv">
            <button class="btn btn-primary" type="submit">POST NOTICE</button>
        </div> 
    </form>

    @endif
    
@endsection