@extends('layout.adminDashboard')

@section('pageTitle')

Admin Dashboard
    
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
<link rel="stylesheet" href="{{asset('css/admin/regStyle.css')}}">

@endsection

@section('container')
<form method="post">
    @csrf
    <table class="table formTable">
        <tr>
            <td class="labelT">Student Registration</td>
            <td><input type="checkbox" name="" id="student_reg" @if($student_reg=='active') checked @endif ><p id="student_regTxt" class="labelT">TURNED OFF</p></td>
        </tr>
        <tr>
            <td class="labelT">Course Registration</td>
            <td><input  type="checkbox" name="" id="course_reg" @if($course_reg=='active') checked @endif  ><p id="course_regTxt" class="labelT">TURNED OFF</p></td>
        </tr>

    </table>
</form>

<script>
     $(document).ready(function(){
        
        function updateDb()
        {
            if ($('#course_reg').is(":checked"))
            {
                var course_reg = true;
                $('#course_regTxt').text("TURNED ON");
            }
            else
            {
                var course_reg = false;
                $('#course_regTxt').text("TURNED OFF");


            }
            if ($('#student_reg').is(":checked"))
            {
                var student_reg = true;
                $('#student_regTxt').text("TURNED ON");

            }
            else
            {
                var student_reg = false;
                $('#student_regTxt').text("TURNED OFF");


            }
            
            $.ajax({
                   
                    url: "{{route('admin.registration.update')}}"+"?course_reg="+course_reg+"&student_reg="+student_reg,
                    success:function(data)
                    {
    
                    }
                
                })
            
            
           

        }

        $('input').on('click', function () {
            updateDb();
        });

        updateDb();
        
     })
</script>

@endsection