<option value=" ">Select Items</option>
@if(!empty($items))
    @foreach($items as $key => $value)
        <option value="{{ $value->id }}" price="{{ $value->price }}">{{ $value->name }}</option>
    @endforeach
@endif