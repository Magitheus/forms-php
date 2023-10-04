<?php
session_start();
$errorsN = $_SESSION['errorsN'] ?? '';
$errorsD = $_SESSION['errorsD'] ?? '';
$errorsE = $_SESSION['errorsE'] ?? '';
$errorsS = $_SESSION['errorsS'] ?? '';
$errorsF = $_SESSION['errorsF'] ?? '';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
      rel="stylesheet"
      type="text/css"
      href="estilocadastro.css"
      media="screen"
    />
    <link rel="stylesheet" href="estilonav.css">
    <title>Cadastro</title>
</head>

<body>
<nav class="navbar">
        <ul>
            <li><a href="./lista-usuario.php">Lista</a></li>
            <li><a href="./index.php">Cadastro</a></li>
        </ul>
    </nav>
<div class="login-box">
    <form action="./server/cadastrar.php" method="post" enctype="multipart/form-data">
        <div class="user-box">
            <input require="" id="nome" value="<?php if (isset($_SESSION['errorN'])){
                echo $_SESSION['errorN'];
            } ?>" type="text" name="nome" />
            <label for="nome">Nome:</label>
                <?php
                if (!empty($errorsN)) {
                    echo "<p>Por favor, corrija os seguintes erros:</p>";
                    foreach ($errorsN as $error) {
                        echo "<p>$error</p>";
                    }
                }
                ?>
        </div>

        <label for="dn">Data de nascimento:</label>
        <div class="user-box">
            <input id="dn" type="date" name="dn" require=""/>
            <?php
            if (!empty($errorsD)) {
                echo "<p>Por favor, corrija os seguintes erros:</p>";
                foreach ($errorsD as $error) {
                    echo "<p>$error</p>";
                }
            }
            ?>
        </div>

        <div class="user-box">
            <input id="email" value="<?php echo $_SESSION['errorE'] ?? ''; ?> " type="email" name="email" require=""/>
            <label for="email">E-mail:</label>
                <?php
                if (!empty($errorsE)) {
                    echo "<p>Por favor, corrija os seguintes erros:</p>";
                    foreach ($errorsE as $error) {
                        echo "<p>$error</p>";
                    }
                }
                ?>
        </div>
        <div class="user-box">    
            <input id="pass" type="password" name="pass" require=""/>
            <label for="pass">Senha: </label>
        </div>
        
        <label for="foto">Foto:</label>
        <div class="user-box">
            <input id="foto" type="file" name="foto" accept="image/png, image/jpeg, image/jpg" />
            <?php
            if (!empty($errorsF)) {
                echo "<p>Por favor, corrija os seguintes erros:</p>";
                foreach ($errorsF as $error) {
                    echo "<p>$error</p>";
                }
            }
            ?>
        </div>
      
        <center><button type="submit">Enviar<span></span></button></center>
        <?php
            if (!empty($errorsF) || !empty($errorsS) || !empty($errorsE) || !empty($errorsD) || !empty($errorsN)) {
            echo "<p>Seus dados não foram cadastro por causa de alguns erros</p>";
            }
        ?>
    </form>
</div>
</body>

</html>