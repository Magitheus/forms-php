<?php
require_once "conexao.php";

session_start();
// variaveis
$errorsN = array();
$errorsD = array();
$errorsE = array();
$errorsS = array();
$errorsF = array();

// verificacoes
if (isset($_POST['nome'])) {
    $nome = $_POST['nome'];

    if (strlen($nome) > 80) {
        $errorsN[] = "O nome não pode ter mais de 80 caracteres.";
    }

    if (empty($nome)) {
        $errorsN[] = "O campo nome não pode ficar em branco.";
    }

    if (preg_match('/[^\p{L}\s]/u', $nome)) {
        $errorsN[] = "O nome não pode conter caracteres especiais ou números.";
    }
}

if (isset($_POST['dn'])) {
    $dn = $_POST['dn'];
    $dn = date("d-m-Y", strtotime($dn));

    if (empty($dn)) {
        $errorsD[] = "O campo data de nascimento não pode ficar em branco.";
    }

    if (!preg_match('/^(\d{2})-(\d{2})-(\d{4})$/', $dn, $matches)) {
        $errorsD[] = "A data de nascimento deve estar no formato DD-MM-AAAA.";
    }

    list(, $dia, $mes, $ano) = $matches;

    if (!checkdate($mes, $dia, $ano)) {
        $errorsD[] = "A data de nascimento inserida não é válida.";
    }

    $dataNascimento = strtotime("$ano-$mes-$dia");
    $dataAtual = time();
    $idade = date('Y', $dataAtual) - date('Y', $dataNascimento);

    if ($idade < 10 || $idade > 200) {
        $errorsD[] = "A idade deve estar entre 10 e 200 anos.";
    }

    if (!empty($dn) && ($errorsD)) {
        $errorsD[] = "Data inserida: " . $dn;
    }
}

if (isset($_POST['email'])) {
    $email = $_POST['email'];

    if (empty($email)) {
        $errorsE[] = "O campo email não pode ficar em branco.";
    }

    if (strlen($email) > 70) {
        $errorsE[] = "O email inserido é muito longo.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorsE[] = "O email inserido não é válido.";
    } else {
        list(, $dominio) = explode('@', $email);

        if (!checkdnsrr($dominio, 'MX') && !checkdnsrr($dominio, 'A')) {
            $errorsE[] = "O domínio do email não possui registros DNS válidos.";
        }
    }
}

if (isset($_POST['pass'])) {
    $senha = $_POST['pass'];

    if (empty($senha)) {
        $errorsS[] = "O campo senha não pode ficar em branco.";
    }

    if (strlen($senha) > 8) {
        $errorsS[] = "A senha não pode ter mais de 8 caracteres.";
    }

    if (!preg_match('/[A-Z]/', $senha)) {
        $errorsS[] = "A senha deve conter pelo menos uma letra maiúscula.";
    }

    if (!preg_match('/[a-z]/', $senha)) {
        $errorsS[] = "A senha deve conter pelo menos uma letra minúscula.";
    }

    if (!preg_match('/[0-9]/', $senha)) {
        $errorsS[] = "A senha deve conter pelo menos um número.";
    }

    if (!preg_match('/[!@#$%^&*()_+{}\[\]:;<>,.?~\\-]/', $senha)) {
        $errorsS[] = "A senha deve conter pelo menos um caractere especial.";
    }

    if (empty($errorsS)) {
        $pass = sha1($senha);
    }
}

if (isset($_FILES["foto"])) {
    $img = $_FILES["foto"];

    if ($img["error"] == 4) {
        $errorsF[] = "Por favor envie uma foto erro 4";
    } else {

        $name = $img["name"];
        $regex = '/\.(jpg|jpeg|png|gif|bmp)$/i';

        if (!preg_match($regex, $name)) {
            $errorsF[] = "Por favor envie uma foto erro no ext";
        }

        $maxFileSize = 2 * 1024 * 1024; // 2 MB em bytes

        if ($_FILES["foto"]["size"] > $maxFileSize) {
            $errorsF[] = "A imagem deve ter no máximo 2 MB";
        }

        $tamanho = getimagesize($img["tmp_name"]);
        $largura = $tamanho[0];
        $altura = $tamanho[1];
        $proporcaoEsperada = 3 / 4; // Proporção 3x4

        if ($largura / $altura != $proporcaoEsperada) {
            $errorsF[] = "A imagem deve ter uma proporção de 3x4 (largura/altura)";
        }
    }
}

// armazenamento
$_SESSION['errorsN'] = $errorsN;
$_SESSION['errorsD'] = $errorsD;
$_SESSION['errorsE'] = $errorsE;
$_SESSION['errorsS'] = $errorsS;
$_SESSION['errorsF'] = $errorsF;


// recupera os dados
if (empty($errorsN)) {
    $_SESSION['errorN'] = $_POST['nome'];
}

if (empty($errorsE)) {
    $_SESSION['errorE'] = $_POST['email'];
}

if (!empty($errorsF) || !empty($errorsS) || !empty($errorsE) || !empty($errorsD) || !empty($errorsN)) {
    header("Location: ../index.php");
} else {
    $ext = explode(".", $img["name"]);
    $nameFile = md5(uniqid(time())) . "." . $ext[1];
    $path = "../img/" . $nameFile;
    $upar = move_uploaded_file($img["tmp_name"], $path);
    echo $nome . $dn . $email . $pass . $nameFile;

    $dn = date("Y-m-d", strtotime(str_replace("-", "/", $dn)));
    $query = "INSERT INTO usuario(nome, data_nascimento, email, senha, foto) VALUES ('$nome', '$dn', '$email', '$pass', '$nameFile')";

    $resultado = mysqli_query($conexao, $query);
    if ($upar && $resultado) {
        $_SESSION['reset'] = true;
        echo "
        <script>
           alert('Foto upada');
           location.href='../lista-usuario.php';
        </script>";
        exit;
    }
}
?>