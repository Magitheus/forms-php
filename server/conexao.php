<?php 
$HOST = getenv(HOST) ?? 'localhost';
$USER = getenv(USER) ?? 'root';
$DATABASE = getenv(DATABASE) ?? 'revista';
$PASS = getenv(PASS) ?? '1234';
$PORT = getenv(PORT) ?? '3306';

$conexao = mysqli_connect($HOST, $USER, $PASS, $DATABASE, $PORT) or die ("Erro ao conectar");
?>