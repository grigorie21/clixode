<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Clixode admin area</title>
    <link href="/css/app.css" rel="stylesheet"/>
</head>
<body>
<aside>
    <div class="logo">Clixode</div>

    <ul class="side-menu">
        <li>
            <a href="{{route('image.index')}}">Image buckets</a>
        </li>
        <li>
            <a href="{{route('file.index')}}">File buckets</a>
        </li>
        <li>
            <a href="#">User</a>
        </li>
    </ul>
</aside>
<main>
    <div class="header">
        <a href="{{route('image.create')}}" class="button">Create</a>
        <input type="search" name="q"/>
    </div>

    <div class="content">
        @yield('body')
    </div>
</main>
</div>
</body>
</html>
