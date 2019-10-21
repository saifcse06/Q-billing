<option value="">Select Discount</option>
@if(!empty($states))
    @foreach($states as $key => $v)
        <option value="{{ $v->id }}">{{ $v->title }} - {{$v->value}} @if($v->type=="Percentage") % @endif</option>
    @endforeach
@endif