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



$data = json_decode(file_get_contents("php://input"), true);
class registro
{
    private $db;

    public function __construct()
    {
        $this->db = new Database(DBCONFIG);
    }



    public function register($data)
    {
        $textUsername = $data['text_username'];
        $textPass = $data['text_pass'];
        $textConfirm = $data['text_pass_confirm'];

        if (empty($textUsername) || empty($textPass) || empty($textConfirm)) {
            return [
                'status' => 'erro',
                'message' => 'Dados incompletos'
            ];
            exit;
        }

        if ($textPass === $textConfirm) {
            $hash = password_hash($textPass, PASSWORD_DEFAULT);
            $parametro = [
                ':nome' => $textUsername,
                ':senha' => $hash
            ];

            $this->db->execute_non_query(
                'INSERT INTO registros(nome,senha,create_at) VALUES (:nome,:senha, NOW())',
                $parametro
            );
            return [
                'status' => 'ok',
                'message' => 'Cadastro realizado com sucesso'
            ];
        } else {
            return [
                'status' => 'erro',
                'message' => 'Senhas não coincidem'
            ];
        }
    }
}
$registro = new Registro();
echo json_encode($registro->register($data));






