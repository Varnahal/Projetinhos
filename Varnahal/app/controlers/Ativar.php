<?php
namespace App\controlers;
if(!defined('chuvachu')){
    die('vou banir vc HAHAHAHHAHAHAHHAHAHAHHHAHAHAHHAHAHHAHAHAHHAHAHAHAHAHAHAHAHAHAHAHAHAHHHHHAHAHAHHAHAHAHAHHAAAA');
}
class Ativar
{
    private $chave;

    function index(){

        $this->chave = filter_input(INPUT_GET,"chave");
        if(!empty($this->chave))
        {
            $ativar_usuario = new \App\models\AdmsAtivar;
            $ativar_usuario->ValidarChave($this->chave);
            $urlDestino = URL."login/index";
            header("Location:$urlDestino");
        }
        else
        {
            $urlDestino = URL."login/index";
            header("Location:$urlDestino");
            
        }
    }

}


?>