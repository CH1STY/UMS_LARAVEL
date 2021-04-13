@foreach ($data as $co)

<tr>
    <td>{{$co->name}}</td>
    <td>{{$co->course_id}}</td>
    <td>{{$co->prerequisite}}</td>
</tr>
@endforeach
<tr>
    <td colspan="8"><div style="display:flex;justify-content:center;" >{{$data->links()}}</div></td>
</tr>
    
