<?php
$HOST = getenv('MYSQLHOST') !== false ? getenv('MYSQLHOST') : 'localhost';
$USER = getenv('MYSQLUSER') !== false ? getenv('MYSQLUSER') : 'root';
$DATABASE = getenv('MYSQLDATABASE') !== false ? getenv('MYSQLDATABASE') : 'revista';
$PASS = getenv('MYSQLPASSWORD') !== false ? getenv('MYSQLPASSWORD') : 'usbw';
$PORT = getenv('MYSQLPORT') !== false ? getenv('MYSQLPORT') : 3306;


$conexao = 
mysqli_connect($HOST, $USER, $PASS, $DATABASE, $PORT) or die ("Erro ao conectar");
