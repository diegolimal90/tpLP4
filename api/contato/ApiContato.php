<?php
namespace api\contato;

use lib\Model;
use object\contato\Contato;

class ApiContato extends Model{
    
    public function get(Contato $obj){
        $query = $this->first($this->select("SELECT * FROM contato WHERE id = '{$obj->id}'"));
        $this->setObject($obj, $query);
    }

    public function getList(){
        return $this->select("SELECT * FROM contato");
    }

    public function save(Contato $obj){
        if(empty($obj->id)){
            return $this->insert($obj, 'contato');
        }else{
            return $this->update($obj, array('id'=>$obj->id), 'contato');
        }
    }

    public function saveLote(){
        $uploaddir = './files/';
        $uploadfile = $uploaddir . basename($_FILES['file']['name']);

        echo '<pre>';
        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
           $query = "LOAD DATA INFILE {$uploadfile} 
                        INTO TABLE contatos 
                        FIELDS TERMINATED BY ',' 
                        LINES TERMINATED BY '\n'
                        (nome, telefone, email, endereco)";
            if($this->select($query)){
                return true;
            }else{
                return false;
            }

        } else {
            return false;
        }
    }

    public function deletar(Contato $obj){
        return $this->delete(array('id' => $obj->id), 'contato');
    }
}