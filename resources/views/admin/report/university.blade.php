@extends('layout.adminDashboard')

@section('pageTitle')

University Report
    
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
<link rel="stylesheet" href="{{asset('vendor/select2/select2.min.css')}}">
<style>
    body{
        color:green;
    }
</style>
<script src="{{asset('vendor/select2/select2.min.js')}}"></script>



@endsection

@section('container')

<form action="" method="post">
    @csrf
    <table class="table formTable">
        <tr>
            <td>Select University</td>
            <td>
                <select name="university_id" id="university_id">
                    <option value="">Please Select an University</option>
                    @foreach ($university as $u)
                    <option value="{{$u->id}}">{{$u->name}}</option>
                        
                    @endforeach
                </select>

            </td>
            <td class="errorText">{{$errors->first('university_id')}}</td>
        </tr>

    </table>

    <div class="buttonDiv">
        <button class="btn btn-primary" type="submit">Download</button>
    </div> 
</form>

<script>
    $(document).ready(function() {
        $('#university_id').select2();
    });
</script>

@endsection