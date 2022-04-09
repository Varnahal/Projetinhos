<?php
namespace App\controlers;
if(!defined('chuvachu')){
    die('vou banir vc HAHAHAHHAHAHAHHAHAHAHHHAHAHAHHAHAHHAHAHAHHAHAHAHAHAHAHAHAHAHAHAHAHAHHHHHAHAHAHHAHAHAHAHHAAAA');
}
class Login{

    private $dados;
    public function index(){

        $this->dados = filter_input_array(INPUT_POST);
        if(!empty($this->dados['sendLogin'])){
            $visualizar_login = new \App\models\AdmsLogin();
            $visualizar_login->login($this->dados);
            if($visualizar_login->getResultado()){
                $url_destino = URL."home/index";
                header("Location: $url_destino");
            }
            else
            {
                $this->dados['form'] = $this->dados;;
            }
        }      

        $carregar_view = new \Core\ConfigView("views/login/login",$this->dados);
        $carregar_view->renderizar();

    }
}


?>