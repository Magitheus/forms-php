<?php
require_once "./server/conexao.php";

session_start();
$id = $_GET['id'];
$ids = $_SESSION['ids'];

if (!in_array($id, $ids)) {
    header('Location: ./404.php');
    exit;
}

$query = "SELECT * FROM usuario WHERE id_usuario=$id";

$executar = mysqli_query($conexao, $query);
$dados = mysqli_fetch_array($executar);
$dn = date("d-m-Y", strtotime($dados['data_nascimento']));

echo "<p><img src='./img/$dados[foto]'></p>";
echo "<p>Nome: $dados[nome]</p>";
echo "<p>Data Nascimento: $dn</p>";
echo "<p>Email: $dados[email]</p>";
echo "<p>Id: $dados[id_usuario]</p>";
echo "<p><a href=
'./server/excluir.php?id=$dados[id_usuario]'
>Excluir</a></p>";

?>