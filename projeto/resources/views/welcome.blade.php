<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Lanchonete Podrão Admin</title>

    </head>
    <body>
        <center>
            @for ($i = 0; $i < 5; $i++)
                <br>
            @endfor

            @if (isset($msg))
                <p>{{ $msg }}</p>

                @for ($i = 0; $i < 2; $i++)
                    <br>
                @endfor
            @endif

            <h4>Lanchonete Podrão</h4>
            <br><br>

            <form method="post" action="/auth">
                @csrf
                <input type="email" name="email" placeholder="Email"><br><br>
                <input type="password" name="senha" placeholder="Senha"><br><br><br><br>
                <input type="submit" value="Entrar">
            </form>
        </center>
    </body>
</html>
