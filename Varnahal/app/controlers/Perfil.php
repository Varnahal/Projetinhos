<?php
namespace App\controlers;
if(!defined('chuvachu')){
    die('vou banir vc HAHAHAHHAHAHAHHAHAHAHHHAHAHAHHAHAHHAHAHAHHAHAHAHAHAHAHAHAHAHAHAHAHAHHHHHAHAHAHHAHAHAHAHHAAAA');
}
class Perfil{
    private $dados;
    public function index(){
        $carregar_view = new \Core\ConfigView("Views/perfil/perfil",$this->dados);
        $carregar_view->renderizar();
    }

}


?>