<?php
require_once "conexao.php";

$id = $_GET['id'];

$file_query = "SELECT foto FROM usuario WHERE id_usuario = $id";
$exe_file = mysqli_query($conexao, $file_query);
$dados = mysqli_fetch_array($exe_file);

$file = $dados['foto'];

$query = "DELETE FROM usuario WHERE id_usuario=$id";
$executar = mysqli_query($conexao, $query);

$raiz_projeto = __DIR__; // Obtém o diretório atual do script PHP (raiz do projeto)
$path = $raiz_projeto . "/img/" . $File;
$delete = unlink($path);

if ($delete and $executar) {
        echo "
                <script>
                   alert('Conta " . $executar ." e foto deletada. " . $delete ."');
                   location.href='lista-usuario.php';
                </script>";
}
?>