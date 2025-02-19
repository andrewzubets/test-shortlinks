@if(!empty($message))
    <div class="my-3 alert alert-{{$message['type']}}">{{$message['message']}}</div>
@endif
