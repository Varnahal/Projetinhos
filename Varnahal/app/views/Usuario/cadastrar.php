<?php
if(!defined('chuvachu')){
    die('vou banir vc HAHAHAHHAHAHAHHAHAHAHHHAHAHAHHAHAHHAHAHAHHAHAHAHAHAHAHAHAHAHAHAHAHAHHHHHAHAHAHHAHAHAHAHHAAAA');
}
?>
<?php
if (isset($_SESSION['msg'])) {
     echo $_SESSION['msg'];
     unset($_SESSION['msg']);
}
if(isset($this->dados['form'])){
    $valor_form = $this->dados['form'];

}

?>
<h1>Cadastrar</h1>
<form action="" method="post">
    <label for="nome">nome</label>
    <input type="text" name="nome" id="nome" value="<?php if(isset($valor_form['nome'])){echo $valor_form['nome'];}?>" placeholder="digite seu nome"><br><br>

    <label for="email">email</label>
    <input type="email" name="email" id="email" value="<?php if(isset($valor_form['email'])){echo $valor_form['email'];}?>" placeholder="digite seu email"><br><br>

    <label for="Senha">Senha</label>
    <input type="password" name="Senha" id="Senha" placeholder="digite sua Senha"><br><br>

    <input type="submit" value="Cadastrar" name="CadUsuario">
    <p><a href="<?php echo URL;?>login/index">Clique aqui para acessar</a></p>

</form>