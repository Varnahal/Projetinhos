<?php
namespace App\models;
if(!defined('chuvachu')){
    die('vou banir vc HAHAHAHHAHAHAHHAHAHAHHHAHAHAHHAHAHHAHAHAHHAHAHAHAHAHAHAHAHAHAHAHAHAHHHHHAHAHAHHAHAHAHAHHAAAA');
}
use PDO;

class AdmsLogin extends Conn{    

    private bool $resultado = false;
    private $dados;
    private object $conn;
    private $resultadobd;
    public function getResultado():bool{
        return $this->resultado;
    }
    public function login(array $dados = null){
        $this->dados = $dados;
        $this->conn=$this->connect();
        $query_val_login = "SELECT id,nome,email,senha,sitis_usuario_id FROM varnahal.usuarios WHERE email = :email AND sitis_usuario_id = 1 LIMIT 1";
        $result_val_login = $this->conn->prepare($query_val_login);
        $result_val_login->bindParam(":email",$this->dados['usuario'],PDO::PARAM_STR);
        $result_val_login->execute();
        $this->resultadobd = $result_val_login->fetch();
        if( $this->resultadobd){
            if($this->validar_sit())
            {
                $this->validarSenha();
            }
            else
            {
                $this->resultado = false;
            }
        }
        else
        { 
            $_SESSION['msg'] = " usuario nn encontrado ";
            $this->resultado = false;
           
        }
    }
    private function validar_sit()
    {
       if($this->resultadobd['sitis_usuario_id'] <> 1)
        {
            $_SESSION['msg'] = "confirme seu email para ativar a conta" ;
            return false;
        } 
        else
        {
            return true;
        }
    }
    private function validarSenha(){
       
        if(password_verify($this->dados['Senha'],$this->resultadobd['senha'])){
            $_SESSION['usuario_id'] = $this->resultadobd['id'];
            $_SESSION['usuario_nome'] = $this->resultadobd['nome'];
            $_SESSION['usuario_email'] = $this->resultadobd['email'];
            $this->resultado = true;
        }
        else
        {
            $_SESSION['msg'] = " usuario ou senha incorreto "; 
            $this->resultado = false;
        }
    }
}
