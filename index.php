<?php
session_start();
//define diretorio raiz
define('APP_ROOT', 'mvc');
use lib\System;
require_once 'helper/Bootstrap.php';

$system = new System();
$system->run();