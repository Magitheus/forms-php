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
           location.href='index.php';
        </script>";
} else if (!preg_match($regex, $name)) {
    echo "
    <script>
       alert('Por favor envie uma foto erro no ext');
       location.href='index.php';
    </script>";
} else {
    $ext = explode(".", $img["name"]);
    $nameFile = md5(uniqid(time())) . "." . $ext[1];
    $destino = "/img/";
    $temp_atual = sys_get_temp_dir();
    
    $path_temp = $temp_atual . "/" . $nameFile;
    $path_destino = $destino . $nameFile;


if (move_uploaded_file($img["tmp_name"], $path_temp)) {
    // Arquivo movido com sucesso
    echo "O arquivo foi movido para a pasta temporária.";

    // Agora, mova o arquivo da pasta temporária para a pasta de destino
    if (rename($path_temp, $path_destino)) {
        // Arquivo movido com sucesso para a pasta de destino
        echo "O arquivo foi movido para a pasta de destino.";
    } else {
        // Falha ao mover o arquivo para a pasta de destino
        echo "Falha ao mover o arquivo para a pasta de destino.";
    }
} else {
    // Falha ao mover o arquivo para a pasta temporária
    echo "Falha ao mover o arquivo para a pasta temporária.";
}
   
    $query = "INSERT INTO usuario(nome, data_nascimento, email, senha, foto) VALUES ('$nome', '$dn', '$email', '$pass', '$nameFile')";
    
    $resultado = mysqli_query($conexao, $query);
    if ($upar && $resultado) {
        echo "
        <script>
           alert('Foto upada');
           location.href='../';
        </script>";
    }
}
?>