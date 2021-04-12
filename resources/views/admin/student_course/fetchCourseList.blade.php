<option value="">Please Select a Course....</option>
@foreach ($data as $item)
    
    <option value="{{$item->id}}">{{$item->course_id}}-{{$item->name}}</option>

@endforeach