@foreach ($data as $employee)
<tr>
    <td>
        {{$employee->empid}}
    </td>
    <td>
        
        {{$employee->empname}}
    </td>

    <td  align="center"><a href="{{route('admin.resign.accept',['empid'=>$employee->empid])}}"><button class="btn btn-primary">Accept</button></a>
        <a href="{{route('admin.resign.reject',['empid'=>$employee->empid])}}"><button class="btn btn-info">Reject</button></a></td>
</tr>
    
@endforeach