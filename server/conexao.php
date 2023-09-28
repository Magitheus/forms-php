<?php
$HOST = getenv('MYSQLHOST') ?? 'localhost';
$USER = getenv('MYSQLUSER') ?? 'root';
$DATABASE = getenv('MYSQLDATABASE') ?? 'revista';
$PASS = getenv('MYSQLPASSWORD') ?? '1234';
$PORT = getenv('MYSQLPORT') ?? 3306;

$conexao = mysqli_connect($HOST, $USER, $PASS, $DATABASE, $PORT) or die ("Erro ao conectar");
?>