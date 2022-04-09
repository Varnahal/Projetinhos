<?php

class Pessoa{

    private $pdo;

    function __construct($dbname,$host,$user,$pass){
        try{
        $this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host,$user,$pass);
        }catch(PDOException $e)
        {
            echo"erro no banco de dados".$e->getMessage();
            exit();
        }catch(Exception $e)
        {
            echo"erro aleatório".$e->getMessage();
        }
    }
    function BuscarDados(){
        $res =array();
        $cmd =$this->pdo->query("select * from pessoa order by nome");
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    function cadastrar($nome,$telefone,$email){
        $cmd = $this->pdo->prepare("select id from pessoa where email = :email");
        $cmd->bindValue(":email",$email);
        $cmd->execute();
        if($cmd->rowCount() < 1){
        
        $cmd = $this->pdo->prepare("insert into pessoa value(default,:nome,:telefone,:email)");
        $cmd->bindValue(":telefone",$telefone);
        $cmd->bindValue(":nome",$nome);
        $cmd->bindValue(":email",$email);
        $cmd->execute();
            return true;
    }else{
        return false;
    }

    }
    function excluir($id){

        $cmd = $this->pdo->prepare("delete from pessoa where id = :id");
        $cmd->bindValue(":id",$id);
        $cmd->execute();
    }

    function buscarDadosPessoa($id){
        $cmd = $this->pdo->prepare("select nome,telefone,email from pessoa where id = :id");
        $cmd->bindValue(":id",$id);
        $cmd->execute();
        $res = $cmd->fetch(PDO::FETCH_ASSOC);
        return $res;

    }

    function atualizar($id,$n,$t,$e){

        $cmd = $this->pdo->prepare("update pessoa set nome=:n,telefone=:t,email=:e where id = :id");
        $cmd->bindValue(":id",$id);
        $cmd->bindValue(":n",$n);
        $cmd->bindValue(":t",$t);
        $cmd->bindValue(":e",$e);
        $cmd->execute();
    }




}

?>