<?php
session_start();
$errorsN = $_SESSION['errorsN'] ?? '';
$errorsD = $_SESSION['errorsD'] ?? '';
$errorsE = $_SESSION['errorsE'] ?? '';
$errorsS = $_SESSION['errorsS'] ?? '';
$errorsF = $_SESSION['errorsF'] ?? '';
$reset = false;
if ($reset) {
    unset($_SESSION['errorN']);
    unset($_SESSION['errorE']);
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <style>
        form {
            width: 300px;
            display: flex;
            flex-direction: column;
        }
    </style>
</head>

<body>
    <form action="./server/cadastrar.php" method="post" enctype="multipart/form-data">
        <label for="nome">
            Nome: <input id="nome" value="<?php if (isset($_SESSION['errorN'])) {
                                                echo $_SESSION['errorN'];
                                            } ?>" type="text" name="nome" />
            <?php
            if (!empty($errorsN)) {
                echo "<p>Por favor, corrija os seguintes erros:</p>";
                echo "<ul>";
                foreach ($errorsN as $error) {
                    echo "<li>$error</li>";
                }
                echo "</ul>";
            }
            ?>
        </label>
        <label for="dn">
            Data de nascimento: <input id="dn" type="date" name="dn" />
            <?php
            if (!empty($errorsD)) {
                echo "<p>Por favor, corrija os seguintes erros:</p>";
                echo "<ul>";
                foreach ($errorsD as $error) {
                    echo "<li>$error</li>";
                }
                echo "</ul>";
            }
            ?>
        </label>
        <label for="email">
            E-mail: <input id="email" value="<?php echo $_SESSION['errorE'] ?? ''; ?> " type="email" name="email" />
            <?php
            if (!empty($errorsE)) {
                echo "<p>Por favor, corrija os seguintes erros:</p>";
                echo "<ul>";
                foreach ($errorsE as $error) {
                    echo "<li>$error</li>";
                }
                echo "</ul>";
            }
            ?>
        </label>
        <label for="pass">
            Senha: <input id="pass" type="password" name="pass" />
        </label>
        <label for="foto">
            Foto: <input id="foto" type="file" name="foto" accept="image/png, image/jpeg, image/jpg" />
            <?php
            if (!empty($errorsF)) {
                echo "<p>Por favor, corrija os seguintes erros:</p>";
                echo "<ul>";
                foreach ($errorsF as $error) {
                    echo "<li>$error</li>";
                }
                echo "</ul>";
            }
            ?>
        </label>
        <button type="submit">Enviar</button>
    </form>
</body>

</html>