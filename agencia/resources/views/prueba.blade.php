<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <main class="container">
        <h1>Vista de prueba</h1>

        <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum eius excepturi fuga laboriosam necessitatibus obcaecati quae vero. Aperiam doloremque harum, nihil nulla, optio, possimus praesentium similique suscipit temporibus vel voluptates!
        </p>

        <ul class="list-group">
            @for ( $i = 1; $i<13; $i++ )
            <li class="list-group-item"> item de lista {{ $i }} </li>
            @endfor
        </ul>

    </main>

</body>
</html>
