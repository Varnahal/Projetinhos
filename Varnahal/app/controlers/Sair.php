<?php
namespace App\controlers;
if(!defined('chuvachu')){
    die('vou banir vc HAHAHAHHAHAHAHHAHAHAHHHAHAHAHHAHAHHAHAHAHHAHAHAHAHAHAHAHAHAHAHAHAHAHHHHHAHAHAHHAHAHAHAHHAAAA');
}
class Sair{

    public function index(){
        unset($_SESSION['usuario_id'],$_SESSION['usuario_nome'],$_SESSION['usuario_email']);
        $url_destino = URL.'login/index';
        header("Location: $url_destino");

    }
}

?>