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
<h1>Area restrita</h1>

<form action="" method="post">
    <label for="usuario">Úsuario</label>
    <input type="text" name="usuario" id="usuario" value="<?php if(isset($valor_form['usuario'])){echo $valor_form['usuario'];}?>" placeholder="digite seu email"><br><br>

    <label for="Senha">Senha</label>
    <input type="password" name="Senha" id="Senha" placeholder="digite sua Senha"><br><br>

    <input type="submit" value="Acessar" name="sendLogin">
    <p><a href="<?php echo URL;?>cadastrar/index">Cadastrar</a>-esqueceu a senha</p>

</form>