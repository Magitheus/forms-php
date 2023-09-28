<?php
require_once "conexao.php";

$id = $_GET['id'];

$file_query = "SELECT foto FROM usuario WHERE id_usuario = $id";
$exe_file = mysqli_query($conexao, $file_query);
$dados = mysqli_fetch_array($exe_file);

$file = $dados['foto'];

$query = "DELETE FROM usuario WHERE id_usuario=$id";
$executar = mysqli_query($conexao, $query);

$diretorio_destino = "img/";

// Verifique se o diretório de destino existe ou crie-o
if (!is_dir($diretorio_destino)) {
    if (!mkdir($diretorio_destino, 0777, true)) {
        die("Falha ao criar o diretório de destino.");
    }
}
$path = $diretorio_destino . $file;

$delete = unlink($path);

if ($delete and $executar) {
        echo "
                <script>
                   alert('Conta " . $executar ." e foto deletada. " . $delete ."');
                   location.href='lista-usuario.php';
                </script>";
}
?>