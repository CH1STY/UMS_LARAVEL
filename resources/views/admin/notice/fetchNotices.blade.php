@foreach ($data as $ad)

<tr>
    <td >{{$ad->notice_id}}</td>
    <td >{{$ad->details}}</td>
    <td >{{$ad->admin_id}}</td>
    <td >{{$ad->created_at}}</td>
    <td colspan="" align="center"><a onclick="return deleteF()" href="{{route('admin.notice.delete',['notice_id'=> $ad->id ,])}}"><button class="btn btn-danger">Delete</button></a></td>
</tr>
    
@endforeach

<tr>
    <td colspan="5"><div style="display:flex;justify-content:center;" >{{$data->links()}}</div></td>
</tr>