@props(['message'])
<li class="you">
    <div class="entete">
        <h3>{{$message->created_at}}</h3>
        <h2>{{$message->sender->name}}</h2>
        <span class="status blue"></span>
    </div>
    <div class="triangle"></div>
    <div class="message">
        {{$message->body}}
    </div>
</li>
