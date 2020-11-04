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
            <h1>Formulario de envío</h1>

            <div class="alert bg-light shadow-sm p-4">
                <form action="/proceso" method="post">
                    @csrf
                    Frase: <br>
                    <input type="text" name="frase" class="form-control">
                    <br>
                    <button class="btn btn-dark">Enviar frase</button>
                </form>
            </div>

        </main>
    </body>
</html>
