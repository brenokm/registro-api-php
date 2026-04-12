<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href=".\\styles.css">
</head>

<body>
  
    <form class="container card">
        <div class="red">

            <label>Username</label>
            <input type="text" name="text_username">

            <label>Password</label>
            <input type="text" name="text_pass">

            <label>Confirm password</label>
            <input type="text" name="text_pass_confirm">

            <button type="button" onclick="onEntrar()"> Entrar</button>

        </div>
    </form>

    <!-- 🔥 AGORA É MODULE -->
    <script type="module">
        import { mostrarMensagem } from './mensagem.js';

        const onEntrar = () => {

            const username = document.querySelector('[name="text_username"]').value;
            const pass = document.querySelector('[name="text_pass"]').value;
            const confirm = document.querySelector('[name="text_pass_confirm"]').value;

            fetch('http://localhost/registroPHP/tratamento-api.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    text_username: username,
                    text_pass: pass,
                    text_pass_confirm: confirm
                })
            })
            .then(res => res.json())
            .then(data => {
                console.log(data);

                // 🔥 TROCA DO ALERT
                mostrarMensagem(data.message);
            })
            .catch(err => console.log(err));
        }

        // 🔥 NECESSÁRIO PRA FUNCIONAR NO onclick
        window.onEntrar = onEntrar;
    </script>
</body>

</html>