<?php

namespace Core;

class ConfigControler
{
    private string $url;
    private array $urlConjunto;
    private string  $urlController;
    private string $urlMetodo;
    public function __construct()
    {
        if (!empty(filter_input(INPUT_GET, "url", FILTER_DEFAULT))) {
            $this->url = filter_input(INPUT_GET, "url", FILTER_DEFAULT);
            $this->urlConjunto = explode("/", $this->url);
            
            if (isset($this->urlConjunto[0]) && isset($this->urlConjunto[1])) {
                $this->urlController = $this->urlConjunto[0];
                $this->urlMetodo = $this->urlConjunto[1];
            } 
            else
            {
                $this->urlController = "erro";
                $this->urlMetodo = "index";
            }
        }
        else
        {
            $this->urlController = "login";
            $this->urlMetodo = "index";
        }
    }
    public function carregar()
    {
        $this->config();
        $valPermissao = new \Core\Permissao();
        $valPermissao->index($this->urlController);
        $penis = ucwords($this->urlController);
        $classe = "\\App\\controlers\\" . $penis;
        $clsasse_Carregar = new $classe;
        $clsasse_Carregar->index();
    }
    private function config(){
        define("URL",'http://localhost/varnahal/');
    }
}
