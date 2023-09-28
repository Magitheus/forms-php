<?php
require_once "conexao.php";

$nome = $_POST['nome'];
$dn = $_POST['dn'];
$email = $_POST['email'];
$pass = sha1($_POST['pass']);
$img = $_FILES["foto"];

//criar as validaçoes: email, com regex 
$name = $img["name"];
$regex = '/\.(jpg|jpeg|png|gif|bmp)$/i';

$tamanho = getimagesize($img["tmp_name"]);
$largura = $tamanho[0];
$altura = $tamanho[1];


if ($img["error"] == 4) {
    echo "
        <script>
           alert('Por favor envie uma foto erro 4');
           location.href='cadastro.php';
        </script>";
} else if (!preg_match($regex, $name)) {
    echo "
    <script>
       alert('Por favor envie uma foto erro no ext');
       location.href='cadastro.php';
    </script>";
} else {
    $ext = explode(".", $img["name"]);
    $nameFile = md5(uniqid(time())) . "." . $ext[1];
    $dir_atual = __DIR__;
    $path = $dir_atual . "/" . $nameFile;
    $upar = move_uploaded_file($img["tmp_name"], $path);
   
    $query = "INSERT INTO usuario(nome, data_nascimento, email, senha, foto) VALUES ('$nome', '$dn', '$email', '$pass', '$nameFile')";
    
    $resultado = mysqli_query($conexao, $query);
    if ($upar && $resultado) {
        echo "
        <script>
           alert('Foto upada');
           location.href='cadastro.php';
        </script>";
    }
}
?>