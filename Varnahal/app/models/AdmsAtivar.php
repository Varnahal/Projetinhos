<?php
namespace App\models;
if(!defined('chuvachu')){
    die('vou banir vc HAHAHAHHAHAHAHHAHAHAHHHAHAHAHHAHAHHAHAHAHHAHAHAHAHAHAHAHAHAHAHAHAHAHHHHHAHAHAHHAHAHAHAHHAAAA');
}


class AdmsAtivar extends Conn
{
    private $chave;
    private $resultado = false;
    private $resultadobd;
    private $conn;


    function getResultado()
    {
        return $this->resultado;
    }

    function ValidarChave($chave)
    {
        $this->chave = $chave;
        $this->conn = $this->connect();

        $query_val_chave = "SELECT id FROM varnahal.usuarios WHERE chave_ativar = :chave_ativar LIMIT 1";
        $result_val_chave = $this->conn->prepare($query_val_chave);
        $result_val_chave->bindParam(":chave_ativar",$this->chave);
        $result_val_chave->execute();
        $this->resultadobd = $result_val_chave->fetch();
        if($this->resultadobd)
        {
            if($this->ativarUsuario())
            {
                $_SESSION['msg'] = 'deu tudo certo, faça o login';
                $this->resultado = true;
            }
            else
            {
                $_SESSION['msg'] = 'não foi possivel ativar tenta dnv';
                $this->resultado = false;
            }
        }
        else
        {
            $_SESSION['msg'] = 'Link invalido';
            $this->resultado = false;
        }
    }
    private function ativarUsuario()
    {
        $chave_ativar = "";
        $sits_usuario_id = 1;
        $querry_ativar_usuario = "UPDATE Varnahal.usuarios SET chave_ativar = :chave_ativar,sitis_usuario_id = :sits_usuario_id,modified = NOW() WHERE id = :id";
        $ativar_usuario = $this->conn->prepare($querry_ativar_usuario);
        $ativar_usuario->bindParam(":chave_ativar",$chave_ativar);
        $ativar_usuario->bindParam(":sits_usuario_id",$sits_usuario_id);
        $ativar_usuario->bindParam(":id",$this->resultadobd['id']);
        $ativar_usuario->execute();
        if($ativar_usuario->rowCount()>0)
        {
            return true;
        }
        else
        {
            return false;
        }

    }

}


?>