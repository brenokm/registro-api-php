<?php
namespace sys4soft;


use PDO;
use PDOException;
use stdClass;


class Database
{
    private $_host;
    private $_database;
    private $_username;
    private $_password;
    private $_return_type;


    public function __construct($cfg_options, $return_type = 'object')
    {
        $this->_host = $cfg_options['host'];
        $this->_database = $cfg_options['database'];
        $this->_username = $cfg_options['username'];
        $this->_password = $cfg_options['password'];
        if (!empty($return_type) && $return_type == 'object') {
            $this->_return_type = PDO::FETCH_OBJ;
        } else {
            $this->_return_type = PDO::FETCH_ASSOC;
        }
    }
    public function execute_query($sql, $parameters = null)
    {
        $conection = new PDO(
            'mysql:host=' . $this->_host . ';dbname=' . $this->_database . ';charset=utf8',
            $this->_username,
            $this->_password,
            array(PDO::ATTR_PERSISTENT => true)
        );
        try {
            $db = $conection->prepare($sql);
         
            if (!empty($parameters)) {
                $db->execute($parameters);
            } else {
                $db->execute();
            }
            $results = $db->fetchAll($this->_return_type);
        } catch (PDOException $e) {
            $conection = null;
            return $this->_result('error', $e->getMessage(), $sql, null, 0, null);
        }
        $conection = null;
        return $this->_result('sucess', 'sucess', $sql, $results, $db->rowCount(), null);
    }
    public function execute_non_query($sql, $parameters = null)
    {  

        $conection = new PDO(
            'mysql:host=' . $this->_host . ';dbname=' . $this->_database . ';charset=utf8' ,
            $this->_username,
            $this->_password ,
                array(PDO::ATTR_PERSISTENT => true) //caso a coneção caia, agiliza os processos de reconecção
        );

        $conection->beginTransaction();
        try {
            $db = $conection->prepare($sql);
            if (!empty($parameters)) {
                $db->execute($parameters);
            } else {
                $db->execute();
            }
            $last_inserted_id = $conection->lastInsertId();

            $conection->commit(); 
        } catch (PDOException $e) {
            $conection->rollBack();

            $conection = null;
            return $this->_result('error', $e->getMessage(), $sql, null, 0, null);
        }


        $conection = null;
        return $this->_result('sucess', 'sucess', $sql, null, $db->rowCount(), $last_inserted_id);
    }
    private function _result($status, $message, $sql, $results, $affected_rows, $last_id)
    {
        $tmp = new stdClass();
        $tmp->status = $status;
        $tmp->message = $message;
        $tmp->query = $sql;
        $tmp->results = $results;
        $tmp->affected_rows = $affected_rows;
        $tmp->last_id = $last_id;
        return $tmp;
    }
}