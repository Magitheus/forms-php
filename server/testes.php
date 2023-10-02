<?php
session_start();
$errorsN = $_SESSION['errorsN'] ?? '';
$errorsD = $_SESSION['errorsD'] ?? '';
$errorsE = $_SESSION['errorsE'] ?? '';
$errorsS = $_SESSION['errorsS'] ?? '';
$errorsF = $_SESSION['errorsF'] ?? '';
$reset = $_SESSION['reset'] ?? false;
if ($reset) {
  unset($_SESSION['errorN']);
  unset($_SESSION['errorE']);
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Validação de Nome</title>
</head>

<body>
  <form method="post" action="cadastrar.php" enctype="multipart/form-data">
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
      <?php
      if (!empty($errorsS)) {
        echo "<p>Por favor, corrija os seguintes erros:</p>";
        echo "<ul>";
        foreach ($errorsS as $error) {
          echo "<li>$error</li>";
        }
        echo "</ul>";
      }
      ?>
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
    <input type="submit" value="Enviar">
    <?php
    if (!empty($errorsF) || !empty($errorsS) || !empty($errorsE) || !empty($errorsD) || !empty($errorsN)) {
      echo "<p>Seus dados não foram cadastro por causa de alguns erros</p>";
    }
    ?>
  </form>

</body>

</html>