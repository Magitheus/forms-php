<?php
require_once "conexao.php";

$query = "SELECT id_usuario, nome FROM usuario ORDER BY nome ASC";
$executar = mysqli_query($conexao, $query);

echo "
  <table border='1'>
  <tr>
    <td>Nome</td>
    <td>Ver detalhes</td>
  </tr>

";

while ($dados = mysqli_fetch_array($executar)) {
    echo "
    <tr>
        <td>$dados[1]</td>
        <td><a href='detalhes.php?id=$dados[id_usuario]'><img src='magnifying-glass.svg'></a></td>
    </tr>";
}
?>