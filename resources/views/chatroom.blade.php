<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=<device-width>, initial-scale=1.0">
    <title>welcome to lkarti_Club</title>
    <link rel="stylesheet" href="{!! asset('css/chatroom.css') !!}">
</head>

<body>

    <a href="/logout" class="floating_logout">Logout</a>
    <div id="container">
        <aside>
            <header class="club_name">
                Sleep_Club
            </header>
            <ul>
                @foreach ($users as $user)
                    @if ($user->id == $current_user->id)
                        <x-current_user :user='$user' />
                    @else
                        <x-user :user='$user' />
                    @endif
                @endforeach
            </ul>
        </aside>
        <main>
            @if ($current_user->id == 0)
                <div class="SCWS">let's chat !!</div>
            @else
                <header style="display: flex;">
                    <img src="{{asset('img/unknown.jpg')}}" alt="">
                    <div>
                        <h2>Chat with <br><b>{{ $current_user->name }}</b></h2>
                        <h3> {{ $messages->count() }} messages</h3>
                    </div>

                </header>
                <ul id="chat">
                    @foreach ($messages as $message)
                        @if ($message->sender_id == auth()->user()->id)
                            <x-sended :message='$message' />
                        @else
                            <x-received :message='$message' />
                        @endif
                    @endforeach
                </ul>
                <form class="footer" action="/message/store" method="post">
                    @csrf
                    <input type="hidden" name="receiver_id" value="{{ $current_user->id }}">
                    <textarea name="body" placeholder="Type your message"></textarea>

                    <button>send</button>
                </form>
            @endif
        </main>
    </div>
    @if ($current_user->id != 0)


    <script>
        let lastM = {{ $last_message }};
        let user = {{ $current_user->id }};

        let ul = document.getElementById('chat');

        function getLastMessage() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    let messages = JSON.parse(this.responseText);
                    messages.forEach(message => {
                        lastM++;
                        mountMessage(message);
                    });
                }
            };
            xhttp.open("GET", "/refresh/" + user + "/" + lastM, true);
            xhttp.send();
        }

        function mountMessage(message) {
            let li = document.createElement("li");
            if (message.sender_id == user) {
                li.classList.add("you");
            } else {
                li.classList.add("me");
            }

            li.innerHTML = "    <div class='entete'>        <h3>" + message.created_at +
                "</h3>        <h2>new message</h2>        <span class='status blue'></span>    </div>    <div class='triangle'></div>    <div class='message'>  " +
                message.body + "    </div>";
            ul.appendChild(li);
            ul.scrollTop = ul.scrollHeight;
        }


        let counter=1;
        function synch() {
            const i = setInterval(function() {
            getLastMessage();

            counter++;
            if (counter === -5) {
                clearInterval(i);
            }
        }, 3000);
        }
        ul.scrollTop = ul.scrollHeight;
        synch();



    </script>
    @endif
</body>

</html>
