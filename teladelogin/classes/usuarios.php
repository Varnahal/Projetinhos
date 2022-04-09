<?php

class Usuario{
private $pdo;
public $errormsg = "";
function __construct($nome, $host, $usuario, $senha){
try {
    $this->pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha);
} catch (PDOException $e) {
    $errormsg = $e->getMessage();
    return $errormsg;
}

}
function cadastrar($nome,$telefone,$email,$senha){
//verificar se já esta cadastrado o email
$sql = $this->pdo->prepare("select from usuario where email =:e");
$sql->bindValue(':e',$email);
$sql->execute();
if($sql->rowCount() > 0)
{
return false;//já esta cadastrada
}
else
//caso nn cadastrado cadastrar 
{
$sql = $this->pdo->prepare("insert into usuarios values (default,:n,:t,:e,:s)");
$sql->bindValue(":n",$nome);
$sql->bindValue(":t",$telefone);
$sql->bindValue(":e",$email);
$sql->bindValue(":s",md5($senha));
$sql->execute();
return true;
} 

}
function logar($email,$senha){
//verificar se já esta cadastrados
$sql = $this->pdo->prepare("select id from usuarios where email=:e and senha=:s");
$sql->bindValue(":e",$email);
$sql->bindValue(":s",md5($senha));
$sql->execute();
if($sql->rowCount() > 0)
{
//entrar na sessão
$dado = $sql->fetch();
session_start();
$_SESSION['id'] = $dado['id'];
return true;//logou
}
else
{
return false;//não deu
}



}

}

?>