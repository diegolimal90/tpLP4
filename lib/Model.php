<?php

namespace lib;

class Model extends Config{

    protected $conn;

    public function __construct(){
        try{
            $this->conn = new \PDO("mysql:host=". self::srvMyHost .";dbname=". self::srvMyDbname, self::srvMyUser, self::srvMyPass );
            $this->conn->exec("set names ". self::charset );
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }catch(\PDOException $ex){
            die($ex->getMessage());
        }
    }

    
    /**
     * metodo para efetuar inserções
     */
    public function insert($obj, $table){
        try{
            $sql = "INSERT INTO {$table} (". implode(",", array_keys((array) $obj)) .") VALUES ('". implode("','", array_values((array) $obj))."')";
            $state = $this->conn->prepare($sql);
            $state->execute(array('widgets'));
        }catch(\PDOException $ex){
            die($ex->getMessage() . " " . $sql);
        }

        return array('sucesso'=>true, 'feedback'=>'', 'codigo'=>$this->last($table));
    }

    /**
     * metodo para efetuar consultas
     */
    public function select($sql){
        try{
            $comando = $this->conn->prepare($sql);
            $comando->execute();
        }catch(\PDOException $ex){
            die($ex->getMessage() . " " . $sql);
        }

        $retorno = array();
        while ($row = $comando->fetchObject()) {
            array_push($retorno,$row);
        }
        return $retorno;
    }

    /**
     * metodo para efetuar Atualizações
     */
    public function update($obj, $condicao, $table){
        try{
            foreach ($obj as $ind => $val) {
                $dados[] = "`{$ind}` = " . (is_null($val) ? "NULL " : "'{$val}'");
            }
            foreach ($condicao as $ind => $val) {
                $where[] = "`{$ind}` " . (is_null($val) ? "IS NULL " : " = '{$val}'");
            }

            $sql= "UPDATE {$table} SET " . implode(',', $dados) . " WHERE " . implode("AND", $where);

            $state = $this->conn->prepare($sql);
            $state->execute(array('widgets'));

        }catch(\PDOException $ex){
            die($ex->getMessage() . " " . $sql);
        }

        return array('sucesso'=>true, 'feedback'=>'');
    }

    /**
     * metodo para efetuar exclusoes
     */
    public function delete($condicao, $table){
        try{
            foreach ($condicao as $ind => $val) {
                $where[] = " {$ind} " . (is_null($val) ? "IS NULL " : " = {$val} ");
            }

            $sql= "DELETE FROM {$table} WHERE " . implode("AND", $where);

            $state = $this->conn->prepare($sql);
            $state->execute(array('widgets'));

        }catch(\PDOException $ex){
            die($ex->getMessage() . " " . $sql);
        }

        return array('sucesso'=>true, 'feedback'=>'');
    }

    /**
     * metodo para 
     */
    public function first($obj){
        if(isset($obj[0])){
            return $obj[0];
        }else{
            return null;
        }
    }

    /**
     * metodo para
     */
    public function last($table){
        try{
            $sql = $this->conn->prepare("SELECT last_insert_id() AS last FROM {$table}");
            $sql->execute();
            $retorno = $sql->fetchObject();
        }catch(\PDOException $ex){
            die($ex->getMessage());
        }

        return $retorno->last;
    }

    public function setObject($obj, $values, $existe = true ){;
        if( is_object($obj)){
            if(is_object($values)){
                foreach ($values as $i => $v) {
                    if(property_exists($obj, $i) || $existe){
                        $obj->$i = $values->$i;
                    }
                }
            }
        }

        return $obj;
    }
}