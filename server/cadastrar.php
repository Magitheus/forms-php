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

// Obtenha o diretório temporário
$temp_dir = sys_get_temp_dir();

// Caminho completo para salvar o arquivo no diretório temporário
$temp_path = $temp_dir . "/" . $nameFile;

if (move_uploaded_file($img["tmp_name"], $temp_path)) {
    // Arquivo movido para o diretório temporário com sucesso

    // Agora, você pode processar o arquivo ou copiá-lo para o local desejado
    // Por exemplo, copiá-lo para um diretório no seu servidor
    $dest_dir = "/app/server/img/";
    $dest_path = $dest_dir . $nameFile;

    if (copy($temp_path, $dest_path)) {
        // Arquivo copiado com sucesso para o diretório final
        echo "O arquivo foi carregado e copiado com sucesso para $dest_path.";
    } else {
        echo "Falha ao copiar o arquivo para o diretório final.";
    }

    // Após copiar, você pode excluir o arquivo temporário
    unlink($temp_path);
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