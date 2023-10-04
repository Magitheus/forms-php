<?php
session_start();
require_once "./server/conexao.php";
?>
<html>
  <link rel="stylesheet" type="text/css" href="estilo-lista.css">
</html>
<?php

$query = "SELECT id_usuario, nome FROM usuario ORDER BY nome ASC";
$executar = mysqli_query($conexao, $query);
$ids = array();

echo '
  <div class="container">
  <h1>lista de Usuarios</h1>
  <ul class="lista-estilizada">
';

while ($dados = mysqli_fetch_array($executar)) {
  $ids[] = $dados['id_usuario'];
    echo "

        <li>$dados[1] 
        <a href='detalhes.php?id=$dados[id_usuario]'><img src='./assets/magnifying-glass.svg'></a>
        </li>
";
}
echo '
</ul>
</div>';

$_SESSION['ids'] = $ids;
?>