@foreach ($data as $subject)
<tr>
    
    <td>{{$subject->csname}}</td>
    <td>{{$subject->cuname}}</td>
    <td>{{$subject->cdname}}</td>
    <td><a href="{{route('admin.subject.edit',['ad_id'=> $subject->id])}}"><button class="btn btn-info">Edit</button></a></td>
</tr>
    
@endforeach

<tr>
   
    <td colspan="6"><div style="display:flex;justify-content:center;" >{{$data->links()}}</div></td> 
 
</tr>
