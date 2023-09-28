<?php 
require_once "./server/conexao.php";

// esse usurario está no banco de dados?
// usurario nao existe
$id = $_GET['id'];

$query = "SELECT * FROM usuario WHERE id_usuario=$id";

$executar = mysqli_query($conexao, $query);
$dados = mysqli_fetch_array($executar);

echo "<p><img src='./temp/$dados[foto]'></p>";
echo "<p>Nome: $dados[nome]</p>";
echo "<p>Data Nascimento$dados[data_nascimento]</p>";
echo "<p>Email: $dados[email]</p>";
echo "<p>Id: $dados[id_usuario]</p>";
echo "<p><a href=
'./server/excluir.php?id=$dados[id_usuario]'
>Excluir</a></p>";

// print_r($dados);
?>