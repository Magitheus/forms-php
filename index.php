<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro teste</title>
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
            Nome: <input id="nome" type="text" name="nome"/>
        </label>
        <label for="dn">
            Data de nascimento: <input id="dn" type="date" name="dn"/>
        </label>
        <label for="email">
            E-mail: <input id="email" type="email" name="email"/>
        </label>
        <label for="pass">
            Senha: <input id="pass" type="password" name="pass"/>
        </label>
        <label for="foto">
            Foto: <input id="foto" type="file" name="foto" accept="image/png, image/jpeg, image/jpg"/>
        </label>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>