<?php
namespace helper;

class Seguranca{

    public function __construct(){
        if(!isset($_SESSION["LOGADO"]) || empty($_SESSION["LOGADO"]) ){
            header('location:/' . APP_ROOT . '/app/sessao');
        }
    }
}