@props(['user'])
<li>
    <a class="USER" href="/chatroom/{{$user->id}}"><img width="50px" src="{{asset('img/unknown.jpg')}}" alt="">
    <div>
        <h2>{{$user->name}}</h2>
        <h3>
            @if ($user->online)
            <span class="status green"></span>
            online
            @else
            <span class="status orange"></span>
            offline
            @endif

        </h3>
    </div>
</a>
</li>
