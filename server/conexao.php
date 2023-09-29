<?php
include_once('./env.php');
$HOST =  getenv('MYSQLHOST');
$USER = getenv('MYSQLUSER');
$DATABASE = getenv('MYSQLDATABASE');
$PASS = getenv('MYSQLPASSWORD');
$PORT = getenv('MYSQLPORT');
$conexao = 
mysqli_connect($HOST, $USER, $PASS, $DATABASE, $PORT) or die ("Erro ao conectar");
