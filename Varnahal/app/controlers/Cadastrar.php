<?php
namespace App\controlers;
if(!defined('chuvachu')){
    die('vou banir vc HAHAHAHHAHAHAHHAHAHAHHHAHAHAHHAHAHHAHAHAHHAHAHAHAHAHAHAHAHAHAHAHAHAHHHHHAHAHAHHAHAHAHAHHAAAA');
}
class Cadastrar{
    private $dados;
    public function index(){
        $this->dados = filter_input_array(INPUT_POST,FILTER_DEFAULT);
        if(!empty($this->dados['CadUsuario']))
        {
            $cadusuario = new \App\models\AdmsCadastrar();
            if($cadusuario->cadastrar($this->dados))
            {
               // $urlDestino = URL."login/index";
               // header("Location:".$urlDestino);
            }
            else
            {
                $this->dados['form'] = $this->dados;
            }
        }
        $carregar_view = new \Core\ConfigView("Views/Usuario/cadastrar",$this->dados);
        $carregar_view->renderizar();
    }

}


?>