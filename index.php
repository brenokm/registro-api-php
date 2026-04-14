<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href=".\style.css">
</head>

<body>

    <form class="container card">
        <div class="red">

            <label>Username</label>
            <input type="text" name="text_username">

            <label>Password</label>
            <input type="text" name="text_pass">


            <button type="button" onclick="onEntrar()"> Entrar</button>
            <a href=".\registro.php" class="altern"> registrar</a>

        </div>

        <script type="module">
            import { mostrarMensagem } from './mensagem.js';
            const onEntrar = () => {
                const textUsername = document.querySelector('[name="text_username"]').value;
                const textPass = document.querySelector('[name="text_pass"]').value;

                fetch("http://localhost/registroPHP/tratamento-login.php", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            text_username: textUsername,
                            text_pass: textPass
                        }),
                    })
                    .then(res => res.json())
                    .then(data => {
                        console.log(data);

                        if (data.status === 'ok') {
                            mostrarMensagem("Login realizado!");
                        } else {
                            mostrarMensagem(data.message);
                        }
                    })
                    .catch(err => console.log(err));
            }
            window.onEntrar = onEntrar;
        </script>
    </form>
</body>
