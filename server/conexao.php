<?php
function conectarDB() {
  $servidor = getenv('HOST');
  $usuario = getenv('USER');
  $senha = getenv('PASS');
  $bd = getenv('DATABASE');
  $port = getenv('PORT');

  if (!$servidor || !$usuario || !$senha || !$bd || !$port) {
      die("As informações de conexão não foram configuradas corretamente.");
  }

  $cnx = mysqli_connect($servidor, $usuario, $senha, $bd, $port);
  return $cnx;
}


if ($conexao) {
  error_log ("Conectado");
} else {
  error_log ("Não conectado");
}
$conexao = conectarDB();
// $HOST = getenv('HOST') ?? 'localhost';
// $USER = getenv('USER') ?? 'root';
// $DATABASE = getenv('DATABASE') ?? 'revista';
// $PASS = getenv('PASS') ?? '1234';
// $PORT = getenv('PORT') ?? 3306;

// $conexao = mysqli_connect($HOST, $USER, $PASS, $DATABASE, $PORT) or die ("Erro ao conectar");
?>