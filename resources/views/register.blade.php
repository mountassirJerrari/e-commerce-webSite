<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Design by foolishdeveloper.com -->
    <title>register at lkarti_Club</title>

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
    <form action="/register" method="POST">
        <h3>register </h3>
        @csrf


        <label for="username">Username</label>
        @error ('name')
        <div class="red-alert">{{$message;}}</div>
       @enderror
        <input name="name" type="text" placeholder="username.." id="username">
        <label for="email">email</label>
        @error ('email')
        <div class="red-alert">{{$message;}}</div>
       @enderror
        <input name="email" type="text" placeholder="email..." id="email">

        <label for="password">Password</label>
        @error ('password')
        <div class="red-alert">{{$message;}}</div>
       @enderror
        <input  name="password" type="password" placeholder="Password..." id="password">

        <button>register</button>
        <div class="social">
            <a href="/">already has an account ?</a>
        </div>
    </form>
</body>
</html>
