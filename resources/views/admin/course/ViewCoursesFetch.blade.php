@foreach ($data as $course)
<tr>
    <td>{{$course->cname}}</td>
    <td>{{$course->csname}}</td>
    <td>{{$course->cuname}}</td>
    <td>{{$course->cdname}}</td>
    <td>{{$course->csemester}}</td>
    <td><a href="{{route('admin.course.edit',['ad_id'=> $course->id])}}"><button class="btn btn-info">Edit</button></a></td>
</tr>
    
@endforeach

<tr>
   
    <td colspan="6"><div style="display:flex;justify-content:center;" >{{$data->links()}}</div></td> 
 
</tr>
