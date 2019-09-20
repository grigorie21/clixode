<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Clixode admin area</title>
    <link href="/css/app.css" rel="stylesheet"/>
</head>
<body>
    <form class="auth" method="POST" action="{{route('auth.login')}}">
        @csrf
        <input type="text" name="email" />
        <input type="password" name="password" />
        <button type="submit">Login</button>
    </form>
</body>
</html>
