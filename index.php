<?php
error_reporting(E_ALL);
//define diretorio raiz
define('APP_ROOT', 'framework');
use lib\System;
require_once 'helper/Bootstrap.php';

// $dados = array(
//         "values"=>array(
//             "column1"=>"t.nome",
//             "column2"=>"t.sobrenome",
//             "column3"=>"t.telefone"
//         ),
//         "table"=>"teste t",
//         "relations"=>array(
//             "rigth_join"=>array(
//                 "table"=>"teste t2",
//                 "column"=>"t2.id_teste",
//                 "key_relation"=>"t.id"
//             )
//         ),
//         "where"=>array(
//             "rigth_join"=>array(
//                 "table"=>"teste t2",
//                 "column"=>"t2.id_teste",
//                 "key_relation"=>"t.id"
//             )
//         )
// );



$system = new System();
$system->run();