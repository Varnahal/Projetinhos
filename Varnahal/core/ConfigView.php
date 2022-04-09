<?php
namespace Core;
class ConfigView{

    private string $nome;
    private $dados;

    public function __construct($nome,array $dados = null) {
        $this->nome = $nome;
        $this->dados = $dados; 
    }
    public function renderizar(){
        if(file_exists('app/'.$this->nome.'.php'))
        {
            include 'app/'.$this->nome.'.php';
        }
        else
        {
            echo"deu erro";
        }

    }

}


?>