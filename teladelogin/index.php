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
        <h1>Entrar</h1>
        <form method="post">
            <input type="email" name="email" placeholder="Usuário">
            <input type="password" name="senha" placeholder="Senha">
            <input type="submit" value="Acessar">
            <a href="cadastrar.php">Ainda não é inscrito <strong>Cadastre-se</strong> </a>
        </form>
    </div>
    <?php
    if(isset($_POST['email']))
    {
        $email = addslashes($_POST['email']);
        $senha = addslashes($_POST['senha']);
        if(!empty($email) && !empty($senha))
        {
            if($u->errormsg === "")
            {
                if($u->logar($email,$senha))
                {
                    header("location:AreaPrivada.php");
                }
                else
                {
                    echo"<div class='msg-erro'>Email ou senha tá errado irmão</div>";
                };
            }
            else
            {
                echo"<div class='msg-erro'>ERRO:$u->errormsg</div>"; 
            }

        }
        else
        {
            echo"<div class='msg-erro'>preenche os bagui</div>";
        }
    
    
    }
    
    
    ?>
</body>
</html>