<?php

use sys4soft\Database;

session_start();

require_once('database.php');


define(
    'DBCONFIG',
    [
        'host' => 'localhost',
        'database' => 'cadastro',
        'username' => 'root',
        'password' => '',
    ]
);
$db = new Database(DBCONFIG);


//inset
$parametro = [':nome' => $_POST['text_username'], ':senha' => $_POST['text_pass']];
$confirmacao = $_POST['text_pass_confirm'];

if ($parametro[':senha'] === $confirmacao) {

    $results = $db->execute_non_query(
        'INSERT INTO registros(nome,senha,create_at) VALUES (:nome,:senha, NOW())',
        $parametro
    );

    $_SESSION['mensagem'] = 'Cadastro realizado com sucesso';

    header('Location: index.php');
    exit;
} else {
    $_SESSION['mensagem'] = 'Senhas não coincidem';

    header('Location: index.php');
    exit;
}


//if($parametro = [':confirmacao'] === $parametro = [':senha']){
//    $results = $db->execute_non_query('INSERT INTO registros(nome,senha,create_at) VALUES (:nome,:senha, NOW())', $parametro);
//}
