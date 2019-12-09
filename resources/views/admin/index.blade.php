<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Clixode admin area</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="/css/app.css" rel="stylesheet"/>
</head>
<body>
<div id="app">
    <aside>
        <div class="logo">Clixode</div>

        <ul class="side-menu">
            <li>
                <b-link :to="{name: 'index'}">Home</b-link>
            </li>
            <li>
                <b-link :to="{name: 'image-buckets'}">Image buckets</b-link>
            </li>
            <li>
                <a href="#">User</a>
            </li>
        </ul>
    </aside>
    <main>
        <router-view></router-view>
    </main>
</div>

<script src="/js/app.js"></script>
</body>
</html>
