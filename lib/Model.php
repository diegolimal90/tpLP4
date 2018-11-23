<?php

namespace lib;

class Model{

    private $conn;

    public __construct(){
        $this->setConn( new PDO("mysql:host=localhost;dbname=agenda", "root", ""));
    }

    public function getConn(){
        return $conn;
    }
    
    public function setConn($conn){
        $this->conn = $conn;
    }

    public function insert($dados){
        $cont = 0;
        $sql = "INSERT INTO ";
        if(is_array($dados)){
            foreach ($dados as $index => $value) {
                if($index == "table"){
                    $sql .= $value . " VALUES (";
                }else{
                    if($index == "values" && is_array($value)){
                        foreach ($dados["values"] as $i => $v) {
                            if(!empty($i)){
                                $cont++;
                                if($cont < sizeof($dados["values"])){
                                    $sql .= "?, ";
                                }else{
                                    $sql .= "?)";
                                }
                            }else{
                                exit("O indice do campo {$v} nao pode estar ser nulo!");
                            }
                        }
                        echo $sql;
                    }else{
                        exit("O indice do campo values nao existe e deveconter um array com os campos!");
                    }                    
                }
            }  
        }else{
            exit("o array enviado nao se encontra no padrao do framework");
        }
    }
    public function select($dados){
        $cont = 0;
        $sql = "SELECT ";
        if(is_array($dados)){
            foreach ($dados as $index => $value) {
                if($index == "values" && is_array($value) && !empty($value)){
                    foreach ($dados["values"] as $i => $v) {
                        $cont++;
                        if($cont < sizeof($dados["values"])){
                            $sql .= "{$v}, ";
                        }else{
                            $sql .= "{$v} ";
                        }
                    }
                }
                if($index == "table"){
                        $sql .= " FROM " . $value;
                } 
                if($index == "relations"){
                        if(is_array($value)){
                            foreach ($dados["relations"] as $k => $v) {
                                switch ($k) {
                                    case 'inner_join':
                                        $sql .= " INNER JOIN ";
                                        foreach ($dados["relations"]['inner_join'] as $ind => $val) {
                                            if($ind == "table"){
                                                $sql .= "{$val} ON ";
                                            }else if($ind == "column"){
                                                $sql .= "{$val} = ";
                                            }else if($ind == "key_relation"){
                                                $sql .= "{$val}";
                                            }else{
                                                exit("verificar array de relacionamento!");
                                            }
                                        }
                                        break;
                                    
                                    case 'left_join':
                                        $sql .= " LEFT JOIN ";
                                        foreach ($dados["relations"]['left_join'] as $ind => $val) {
                                            if($ind == "table"){
                                                $sql .= "{$val} ON ";
                                            }else if($ind == "column"){
                                                $sql .= "{$val} = ";
                                            }else if($ind == "key_relation"){
                                                $sql .= "{$val}";
                                            }else{
                                                exit("verificar array de relacionamento!");
                                            }
                                        }
                                        break;

                                    case 'rigth_join':
                                        $sql .= " RIGTH JOIN ";
                                        foreach ($dados["relations"]['rigth_join'] as $ind => $val) {
                                            if($ind == "table"){
                                                $sql .= "{$val} ON ";
                                            }else if($ind == "column"){
                                                $sql .= "{$val} = ";
                                            }else if($ind == "key_relation"){
                                                $sql .= "{$val}";
                                            }else{
                                                exit("verificar array de relacionamento!");
                                            }
                                        }
                                        break;
                                    
                                    default:
                                        break;
                                }
                            }
                        }
                    echo $sql;       
                }
                if($index == "where"){
                    if(is_array($value)){
                        foreach ($dados["where"] as $i => $v) {
                            # code...
                        }
                    }else{
                        exit("O indice WHERE não esta no padrão do framework!");
                    }
                }
            }                   
        }else{
            exit("o array enviado nao se encontra no padrao do framework");
        }
    }

    public function update($dados){
        
    }

    public function delete($dados){
        
    }
}