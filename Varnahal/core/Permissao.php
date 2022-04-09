<?php
namespace Core;
class Permissao{
   private $urlController;
   private $pgPublica;
   private $pgRestrita;
   private $resultado;

   function getResultado(){
       return $this->resultado;
   }

   function index($urlController){
       $this->urlController = $urlController;
       $this->pgPublica = ['login','sair','cadastrar','ativar'];
       if(in_array($this->urlController,$this->pgPublica)){
            $this->resultado = $this->urlController;
       }
       else
       {
            $this->pgRestrita();
       }
   }
   function pgRestrita(){
       $this->pgRestrita = ['home','perfil'];
       if(in_array($this->urlController, $this->pgRestrita))
        {
            $this->verificarLogin();
        }  
        else
        {
            $_SESSION['msg'] = 'erro pagina nn encontrada menó';
            $urlDestino = URL.'login/index';
            header("Location: $urlDestino");
        }
    }
    function verificarLogin(){
        if(isset($_SESSION['usuario_id'])&&isset($_SESSION['usuario_nome'])&&isset($_SESSION['usuario_email'])){
            $this->resultado = $this->urlController;
        }
        else
        {
            $_SESSION['msg'] = 'vou te dar ban HAHAHAHAHHAHHAHAHHAHAHHAHAHA';
            $urlDestino = URL.'login/index';
            header("Location: $urlDestino");
        }
    }
}

?>