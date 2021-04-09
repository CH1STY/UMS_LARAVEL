@foreach ($data as $ad)

<tr>
    <td>{{$ad->name}}</td>
    <td>{{$ad->email}}</td>
    <td>{{$ad->phone}}</td>
    <td>{{$ad->status}}</td>
    <td>{{$ad->university_id}}</td>
    <td>{{$ad->admin_id}}</td>
    <td>{{$ad->updated_at}}</td>
    <td colspan="" align="center"><a href="{{route('admin.edit.student',['ad_id'=> $ad->id ,])}}"><button class="btn btn-primary">Edit</button></a></td>
    <td colspan="" align="center"><a href="{{route('admin.details.student',['ad_id'=> $ad->id ,])}}"><button class="btn btn-info">Details</button></a></td>
</tr>
    
@endforeach

<tr>
    <td colspan="9"><div style="display:flex;justify-content:center;" >{{$data->links()}}</div></td>
</tr>
