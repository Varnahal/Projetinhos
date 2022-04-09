<?php

class Pessoa{
    private $pdo;

    function __construct($dbname,$host,$user,$senha)
    {
        try{
        $this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host,$user,$senha);
    }catch(PDOException $e){
        echo "erro no banco de dados ". $e->getMessage();
        exit();
    }catch(Exception $e){
        echo "erro generico ". $e->getMessage();
    }
    }

    //funçao de buscar dados e colocar no lado direito
  function buscardados(){
      $res = array();
    $cmd = $this->pdo->query("select * from pessoa order by id desc");
    $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
    return $res;
}  

    function Cadastrar($nome,$telefone,$email)
    {
        //verificar se pessoa já esta cadastrada
        $cmd = $this->pdo->prepare("select id from pessoa where email =:e");
        $cmd->bindValue(':e',$email);
        $cmd->execute();
        if($cmd->rowCount()> 0){
            return false;
        }else
        {
        //cadastrar pessoa
        $cmd = $this->pdo->prepare("insert into pessoa value(default,:n,:t,:e)");
        $cmd->bindValue(':e',$email);
        $cmd->bindValue(':t',$telefone);
        $cmd->bindValue(':n',$nome);
        $cmd->execute();
        return true;
        }
    }   

    function excluirPessoa($id)
    {
        $cmd = $this->pdo->prepare("delete from  pessoa where id = :id");
        $cmd->bindValue(':id',$id);
        $cmd->execute();


    }
    //buscar dados
    function buscarDadosPessoa($id)
    {
        $res = array();
        $cmd = $this->pdo->prepare("select * from pessoa where id = :id");
        $cmd->bindValue(':id',$id);
        $cmd->execute();
        $res = $cmd->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    //atualizar dados
    function atualizarDados($nome,$telefone,$email,$id)
    {
        $cmd = $this->pdo->prepare("select id from pessoa where email = :e and id <> :id");
        $cmd->bindValue(':e',$email);
        $cmd->bindValue(':id',$id);
        $cmd->execute();
        if($cmd->rowCount() > 0)
        {
            return false;
        }else
        {
        $cmd = $this->pdo->prepare("update pessoa set nome = :n, telefone = :t, email = :e where id = :id");
        $cmd->bindValue(':n',$nome);
        $cmd->bindValue(':t',$telefone);
        $cmd->bindValue(':e',$email);
        $cmd->bindValue(':id',$id);
        $cmd->execute();  
        return true;
        }
    }
}





?>