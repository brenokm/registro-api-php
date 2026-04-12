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
    <?php
    if (isset($_SESSION['mensagem'])) {
        include('mensagem.php');
    }
    ?>
    <form class="container card" action="tratamento.php" method="post">
        <div class="red">

            <label for="textUsername">Username</label>
            <input type="text" name="text_username">

            <label for="textPass">Password</label>
            <input type="text" name="text_pass">

            <label for="textPass">Confirm password</label>
            <input type="text" name="text_pass_confirm">

            <button type="submit"> Entrar</button>
        </div>
    </form>

</body>

</html>