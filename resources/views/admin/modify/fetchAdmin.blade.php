@foreach ($data as $ad)

            <tr>
                <td>{{$ad->name}}</td>
                <td>{{$ad->admin_id}}</td>
                <td>{{$ad->email}}</td>
                <td>{{$ad->phone}}</td>
                <td>{{$ad->created_at}}</td>
                <td colspan="" align="center"><a href="{{route('admin.details.admin',['ad_id'=> $ad->id ,])}}"><button class="btn btn-info">Details</button></a></td>
            </tr>
                
@endforeach

    <tr>
        <td colspan="6"><div style="display:flex;justify-content:center;" >{{$data->links()}}</div></td>
    </tr>

    
