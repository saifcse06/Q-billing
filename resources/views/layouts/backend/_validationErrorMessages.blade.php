@if($errors->any())
    <ul class="alert alert-danger fade in animated slideInRight alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close"><i  class="fa fa-times" aria-hidden="true"></i></a>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif