<?php
require_once 'classes/usuarios.php';
$u = new Usuario("projeto_login","localhost","root","");

?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <title>Document</title>
</head>
<body>
    <div id="corpoform">
        <h1>Cadastrar</h1>
        <form method="post">
            <input type="text" name="nome" placeholder="nome" maxlength="30" required>
            <input type="text" name="telefone" placeholder="Telefone" maxlength="30" required>
            <input type="email" name="email" placeholder="Usuário" maxlength="48" required>
            <input type="password" name="senha" placeholder="Senha" maxlength="15" required>
            <input type="password" name="confi_senha" placeholder="Confirmar Senha" maxlength="15" required>
            <input type="submit" value="Cadastrar">
            <a href="index.php">Já é inscrito? Vá fazer o <strong>Login</strong> </a>
        </form>
    </div>
    <?php
    
    //verificar se clicou no botão
    if(isset($_POST['nome']))
    {
        $nome = addslashes($_POST['nome']);
        $telefone = addslashes($_POST['telefone']);
        $email = addslashes($_POST['email']);
        $senha = addslashes($_POST['senha']);
        $conf_senha = addslashes($_POST['confi_senha']);
        if(!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($conf_senha))
        {
            if($u->errormsg === "")
            {
                if($senha === $conf_senha)
                {
                    if($u->cadastrar($nome,$telefone,$email,$senha))
                    {
                        echo"<div id='msg-sucesso'>cadastrado com sucesso</div>";
                    }else
                    {
                        echo"<div class='msg-erro'>email já cadastrado</div>";
                    };
                }
                else
                {
                    echo"<div class='msg-erro'>tu é burro? é pra digitar a senha igual nos dois campos</div>";
                }
            }
            else
            {
                echo"<div class='msg-erro'>ERRO:$u->errormsg</div>";
            }

        }else
        {
            echo"<div class='msg-erro'>preenche os bagui</div>";
        }
    }
    
    ?>
</body>
</html>