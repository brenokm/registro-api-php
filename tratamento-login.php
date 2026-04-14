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

// pegar JSON
$data = json_decode(file_get_contents("php://input"), true);

class Login
{
    private $db;

    public function __construct()
    {
        $this->db = new Database(DBCONFIG);
    }

    public function search($data)
    {
       
        $textUsername = $data['text_username']?? '';
        $textPass = $data['text_pass']?? '';

        if (empty($textUsername) || empty($textPass)) {
            return [
                'status' => 'erro',
                'message' => 'Preencha os campos'
            ];
        }
       
        $params = [
            ':username' => $textUsername
        ];
        $sql = "SELECT * FROM registros WHERE nome = :username";

        $response = $this->db->execute_query($sql, $params);

        
        if ($response->status === 'error') {
            return [
                'status' => 'erro',
                'message' => 'Erro no servidor'
            ];
        }

        $result = $response->results;

    
        if (empty($result)) {
          
        }

        $user = $result[0];

        
        if (!password_verify($textPass, $user->senha)) {
            return [
                'status' => 'erro',
                'message' => 'Senha incorreta'
            ];
        }

        else{
        return [
            'status' => 'ok',
            'message' => 'Login realizado com sucesso'
        ];}
    }
}

// resposta
header('Content-Type: application/json');

$login = new Login();
echo json_encode($login->search($data));