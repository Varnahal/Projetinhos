<?php
require_once 'pessoa.php';
$p = new Pessoa('crud','localhost','root','');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>cadastro de Pessoa</title>
</head>
<body>
    <?php
    
    if(isset($_POST['nome']))//verificando se a pessoa clicou em cadastrar ou editar
    {
        if(isset($_GET['id_up']))
        {
            $id_update = addslashes($_GET['id_up']);
            $nome = addslashes($_POST['nome']);
            $telefone = addslashes($_POST['telefone']);
            $email = addslashes($_POST['email']);
            if(!empty($nome)&& !empty($telefone) && !empty($email))
            {
                $resultado = $p->atualizarDados($nome,$telefone,$email,$id_update);
                if($resultado = true){
                    $p->atualizarDados($nome,$telefone,$email,$id_update);
                header("location: index.php");   
                }else{
                 echo"email já utilizado";
                }  
            }else
            {
                echo"tá faltando coisa irmão";
            }
            //-----------cadastrar----------------------
        }else
        {
          $nome = addslashes($_POST['nome']);
        $telefone = addslashes($_POST['telefone']);
        $email = addslashes($_POST['email']);
        if(!empty($nome)&& (!empty($telefone)) && (!empty($email)))
        {
            if(!$p->Cadastrar($nome,$telefone,$email))
            {
                echo"email já cadastrado";
            };
        }else{
            echo"tá faltando coisa irmão";
        }  
        }


        
    }
    
    ?>
    <?php
        if(isset($_GET['id_up']))//verifica se apessoa clicou no botao editar
        {
            $id_update = addslashes($_GET['id_up']);
            $res = $p->buscarDadosPessoa($id_update);
        }
    
    ?>
    <section id="esquerda">
    <form method="post">
    <h2>Cadastrar Pessoa</h2>
    <label for="nome">Nome</label>
    <input type="text" id="nome" name="nome" value="<?php if(isset($res)){echo $res['nome'];}; ?>" required>
    <label for="telefone">Telefone</label>
    <input type="text" id="telefone" name="telefone" value="<?php if(isset($res)){echo $res['telefone'];}; ?>" required>
    <label for="email">Email</label>
    <input type="email" id="email" name="email" value="<?php if(isset($res)){echo $res['email'];}; ?>" required>
    <input type="submit" value="<?php if(isset($res)){echo"editar";}else{echo"cadastrar";} ?>">

    </form>
    </section>
    <section id="direita">
    <table>
    <tr id="titulo">
        <td>NOME</td>
        <td>TELEFONE</td>
        <td colspan="2">EMAIL</td>
    </tr>
        <?php
        $userdatda = $p->buscardados();
    if(count($userdatda))
    {
        for ($i=0; $i < count($userdatda); $i++)
        { 
            echo "<tr>";
            foreach ($userdatda[$i] as $key => $value)
            {
                if($key <> 'id')
                {
                    echo"<td>$value</td>";
                }
            }
            ?>
            <td>
                      <a href='index.php?id_up=<?php echo $userdatda[$i]['id']; ?>'>editar</a>
                      <a href='index.php?id=<?php echo $userdatda[$i]['id']; ?>'>excluir</a>
                  </td>
                  <?php
            echo"</tr>";
        }
        
    }else{
        echo"tu quer procurar nada, só pode, pq nn tem ninguem cadastrado";
    }
        ?>
    </table>
    </section>
    
</body>
</html>
<?php

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $p->excluirPessoa($id);
    header("location: index.php");
}

?>