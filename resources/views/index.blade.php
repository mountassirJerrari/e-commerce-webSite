<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Design by foolishdeveloper.com -->
    <title>lkarti_Club</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <!--Stylesheet-->
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
</head>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form action="/login" method="POST">
        <h3>Login <br>lkarti_Club </h3>
@csrf

        <label for="username">Username</label>

        <input name="name" type="text" placeholder="username..." id="name">

        <label  for="password">Password</label>

        <input name="password"  type="password" placeholder="Password..." id="password">
        @error ('error')
        <div class="red-alert">{{$message;}}</div>
       @enderror
        <button>start chating</button>
        <div class="social">
            <a href="/register">don't have an account ?</a>

        </div>
    </form>
</body>
</html>
