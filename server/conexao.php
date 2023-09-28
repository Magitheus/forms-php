<?php
$HOST =  'containers-us-west-156.railway.app';
$USER ='root';
$DATABASE ='railway';
$PASS = 'sUX9hVAHSUntdGEvZ4gB';
$PORT = 7952;

$conexao = mysqli_connect($HOST, $USER, $PASS, $DATABASE, $PORT) or die ("Erro ao conectar");
?>