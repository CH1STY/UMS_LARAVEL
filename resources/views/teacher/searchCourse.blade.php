@extends('layout.teacherDashboard')

@section('pageTitle')
Teacher Home
@endsection

@section('extraCss')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

@endsection

@section('profilePicSource')

@if ($teacher->profile_pic)
{{asset($teacher->profile_pic)}}
@else
{{asset('images/dummy.png')}}
@endif

@endsection


@section('username')
{{$teacher->name}}
@endsection

@section('container')


        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 align="center" style="padding:2%">SEARCH COURSES </h2>
            </div>
            <div align="center">
                <div class="panel-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="search" name="search" placeholder="Search...">
                    </div>
                </div>
            </div>
        </div>

    <div align="center">
    <table class="table tableCustom" align="center">
        <thead>
            <tr>
                <th>COURSE ID</th>
                <th>COURSE NAME</th>
                <th>COURSE CREDIT</th>
                <th>CREATED AT</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
        </table>

    </div>

<script>
    $(document).ready(function(){

     fetch_course_data();

     function fetch_course_data(query = '')
     {
      $.ajax({
       url:"{{ route('teacher.action') }}",
       method:'GET',
       data:{query:query},
       dataType:'json',
       success:function(data)
       {
        $('tbody').html(data.table_data);
        $('#total_records').text(data.total_data);
       }
      })
     }

     $(document).on('keyup', '#search', function(){
            var query = $(this).val();
            fetch_course_data(query);
     });

    });
    </script>

@endsection
