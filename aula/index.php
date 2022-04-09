<?php require_once 'pessoas.php';
$p = new Pessoa("crud","localhost","root","")
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>tentativa </title>
</head>
<body>

    <?php
    
    if(isset($_POST['nome']))
    {
        if(isset($_GET['id_up']))
        {
            $id = $_GET['id_up'];
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $telefone = $_POST['telefone'];
            if(!empty($nome) && !empty($email) && !empty($telefone))
            {
                $cmd = $p->atualizar($id,$nome,$telefone,$email);
                header("location: index.php");
            }
        }else{

        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
            if(!empty($nome) && !empty($email) && !empty($telefone))
            {
                $cmd = $p->cadastrar($nome,$telefone,$email);
                if(!$cmd)
                {
                    echo"email já existente";

                }
            }
            else
            {
                echo"tá faltando coisa";
            }
        }
    }
    
    ?>
    <?php
    if(isset($_GET['id_up'])){
        $res = $p->buscarDadosPessoa($_GET['id_up']);
    }
    ?>
    <section id="esquerda">
        <div id="conteiner">
            <form method="post">
                <h1>Cadastrar Pessoas</h1>
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" value="<?php if(isset($res)){ echo $res['nome'];} ?>" maxlength="30">
                <label for="telefone">Telefone</label>
                <input type="text" name="telefone" id="telefone" value="<?php if(isset($res)){ echo $res['telefone'];} ?>" maxlength="30">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" value="<?php if(isset($res)){ echo $res['email'];} ?>" maxlength="30">
                <input type="submit" value="<?php if(isset($res)){ echo"editar";}else{echo"cadastrar";}; ?>">

            </form>
        </div>
    </section>
    <section id="direita">
    <table>
    <tr id="titulo">
        <td>NOME</td>
        <td>TELEFONE</td>
        <td colspan="2">EMAIL</td>
    </tr>
    <?php
    $cmd = $p->BuscarDados();
    if(count($cmd))
    {
        for ($i=0; $i < count($cmd); $i++) 
        { 
            echo"<tr id='Conteudo'>";
                foreach ($cmd[$i] as $key => $value)
                {
                    if($key<>"id")
                    {
                        echo"<td>$value</td>";
                    }
                };

            echo"<td><a href='index.php?id=".$cmd[$i]['id']."'>excluir</a>
            <a href='index.php?id_up=".$cmd[$i]['id']."''>Editar</a></td>";
            echo"</tr>";
        }
    }
    ?>
    </table>
    </section>



</body>
</html>
<?php

if(isset($_GET['id'])){
    $p->excluir($_GET['id']);
    header("location: index.php");
}

?>