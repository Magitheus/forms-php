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

// Diretório temporário dentro do diretório atual do script
$temp_dir = __DIR__ . "/temp/";

// Garanta que o diretório temporário exista ou crie-o
if (!is_dir($temp_dir)) {
    if (!mkdir($temp_dir, 0777, true)) {
        die("Falha ao criar o diretório temporário.");
    }
}

$temp_path = $temp_dir . $nameFile;

if (move_uploaded_file($img["tmp_name"], $temp_path)) {
    // Arquivo movido para o diretório temporário com sucesso

    // Diretório final de destino
    $final_dir = __DIR__ . "/server/img/";

    // Garanta que o diretório final exista ou crie-o
    if (!is_dir($final_dir)) {
        if (!mkdir($final_dir, 0777, true)) {
            die("Falha ao criar o diretório final de destino.");
        }
    }

    $final_path = $final_dir . $nameFile;

    if (rename($temp_path, $final_path)) {
        // Arquivo movido para o diretório final com sucesso
        echo "O arquivo foi carregado e movido com sucesso para $final_path.";
    } else {
        echo "Falha ao mover o arquivo para o diretório final.";
    }
} else {
    echo "Falha ao carregar/mover o arquivo para o diretório temporário.";
}

   
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