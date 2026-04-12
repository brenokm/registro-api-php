<?php

use sys4soft\Database;

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

// 🔥 ESSENCIAL PRA FETCH
$data = json_decode(file_get_contents("php://input"), true);

$nome = $data['text_username'];
$senha = $data['text_pass'];
$confirm = $data['text_pass_confirm'];

// validação básica
if (!$nome || !$senha || !$confirm) {
    echo json_encode([
        'status' => 'erro',
        'message' => 'Dados incompletos'
    ]);
    exit;
}

if ($senha === $confirm) {
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
    $db->execute_non_query(
        'INSERT INTO registros(nome,senha,create_at) VALUES (:nome,:senha, NOW())',
        [
            ':nome' => $nome,
            ':senha' => $senhaHash
        ]
    );
    echo json_encode([
        'status' => 'ok',
        'message' => 'Cadastro realizado com sucesso'
    ]);

} else {
    echo json_encode([
        'status' => 'erro',
        'message' => 'Senhas não coincidem'
    ]);
}