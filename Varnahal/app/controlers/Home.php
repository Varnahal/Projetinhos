<?php
namespace App\controlers;
if(!defined('chuvachu')){
    die('vou banir vc HAHAHAHHAHAHAHHAHAHAHHHAHAHAHHAHAHHAHAHAHHAHAHAHAHAHAHAHAHAHAHAHAHAHHHHHAHAHAHHAHAHAHAHHAAAA');
}
class Home{
    private $dados;
    public function index(){
        $carregar_view = new \Core\ConfigView("Views/dashboard/home",$this->dados);
        $carregar_view->renderizar();
    }

}


?>