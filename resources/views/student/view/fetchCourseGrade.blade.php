@foreach ($data as $course)
<tr>
    <td>{{$course->cname}}</td>
    <td>{{$course->cid}}</td>
    <td>{{$course->cmarks}}</td>

</tr>
    
@endforeach

<tr>
   
    <td colspan="6"><div style="display:flex;justify-content:center;" >{{$data->links()}}</div></td> 
 
</tr>
