<?php
namespace lib;

class Objeto{

    public function __construct($method = null, $all = true){
        if($method == "POST"){
            foreach ($_POST as $i => $v) {
                $this->$i = $v;
            }
        }

        if(isset($_FILES)){
            foreach ($_FILES as $i => $v) {
                if($all || isset($this->$i)){
                    $this->$i = $v;
                }
            }
        }
    }
}