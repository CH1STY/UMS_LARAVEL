@foreach ($data as $ad)

<tr>
    <td>{{$ad->name}}</td>
    <td>{{$ad->university_id}}</td>
    <td>{{$ad->address}}</td>
    <td>{{$ad->admin_id}}</td>
    <td>{{$ad->updated_at}}</td>
    <td><a href="{{route('admin.edit.university',['univ_id'=>$ad->id,])}}"><button class="btn btn-primary">Edit</button></a></td>
    <td><a href="{{route('admin.details.university',['univ_id'=>$ad->id,])}}"><button class="btn btn-info">Details</button></a></td>
</tr>
@endforeach
<tr>
    <td colspan="7"><div style="display:flex;justify-content:center;" >{{$data->links()}}</div></td>
</tr>
    
