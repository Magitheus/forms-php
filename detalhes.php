<link rel="stylesheet" href="estilonav.css">
<nav class="navbar">
        <ul>
            <li><a href="./lista-usuario.php">Lista</a></li>
            <li><a href="./index.php">Cadastro</a></li>
          
        </ul>
</nav>
<?php
require_once "./server/conexao.php";

session_start();
$id = $_GET['id'] ?? "";
$ids = $_SESSION['ids'];

if (!in_array($id, $ids)) {
    echo "
    <script>
       alert('Não encontramos esse usuário.');
       location.href='../lista-usuario.php';
    </script>";
    exit;
}

$query = "SELECT * FROM usuario WHERE id_usuario=$id";

$executar = mysqli_query($conexao, $query);
$dados = mysqli_fetch_array($executar);
$dn = date("d-m-Y", strtotime($dados['data_nascimento']));

echo "<div style='text-align: center; background-color: #c5c5c5; padding: 10px; margin: 10px;'>";
echo "<p><img src='./img/$dados[foto]' style='max-width: 100%; height: auto;'></p>";
echo "<p style='font-size: 18px; font-weight: bold;'>Nome: $dados[nome]</p>";
echo "<p>Data Nascimento: $dn</p>";
echo "<p>Email: $dados[email]</p>";
echo "<p>ID: $dados[id_usuario]</p>";
echo "<p><a href=
'./server/excluir.php?id=$dados[id_usuario]' style='text-decoration: none; background-color: #ff0000; color: #000000; padding: 5px 10px; border-radius: 5px;'
>Excluir</a></p>";
?>