<?php

namespace App\models;
if(!defined('chuvachu')){
    die('vou banir vc HAHAHAHHAHAHAHHAHAHAHHHAHAHAHHAHAHHAHAHAHHAHAHAHAHAHAHAHAHAHAHAHAHAHHHHHAHAHAHHAHAHAHAHHAAAA');
}
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

class AdmsCadastrar extends Conn{
private $dados;
private $conn;

    function cadastrar(array $dados = null)
    {
       $this->dados = $dados;
       $this->dados['Senha'] = password_hash($this->dados['Senha'],PASSWORD_DEFAULT);
       $this->dados['chave_ativar'] = password_hash(date("Y-m-d H:i:s"),PASSWORD_DEFAULT);
       $this->conn = $this->connect();

        $querry_cad_usuario = "INSERT INTO varnahal.usuarios (nome,email,senha,chave_ativar,created) VALUES (:n,:e,:s,:chave_ativar,NOW())";
        $cad_usuario = $this->conn->prepare($querry_cad_usuario);
        $cad_usuario->bindParam(":n",$this->dados['nome']);
        $cad_usuario->bindParam(":e",$this->dados['email']);
        $cad_usuario->bindParam(":s",$this->dados['Senha']);
        $cad_usuario->bindParam(":chave_ativar",$this->dados['chave_ativar']);
        $cad_usuario->execute();
        if($cad_usuario->rowCount() > 0)
        {
            $_SESSION['msg'] = "Usuario cadastrado com sucesso";
            $this->EnviarEmail();
            return true;
        }
        else
        {
            $_SESSION['msg'] = "deu erro tente novamente";
            return false;
        }
    }

    private function EnviarEmail(){
        $mail = new PHPMailer(true);
        try
        {
                //Server settings
                //$mail->SMTPDebug = 2;                                         //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.mailtrap.io';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'a4e7ed189588ed';                        //SMTP username
                $mail->Password   = '4241571fee6bf9';                        //SMTP password
                $mail->SMTPSecure = 'tls';                                   //Enable implicit TLS encryption
                $mail->Port       = 2525;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
                //Recipients
                $mail->setFrom('danielmarcelino91@gmail.com', 'Varnahal');
                $mail->addAddress($this->dados['email'], $this->dados['nome']);     //Add a recipient
    
                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Confirmar Email';
                $mail->Body    = "Prezado {$this->dados['nome']}<br>clica no bagui pra confirmar o email<br><br><a href='".URL."ativar/index?chave={$this->dados['chave_ativar']}'>Clique aqui</a>";
                $mail->AltBody = "Prezado {$this->dados['nome']}\ninsira este link na barra de pesquisa para confirmar\n\n ".URL."ativar/index?chave={$this->dados['chave_ativar']}";
                $mail->send();
                $_SESSION['msg'] = "Usuario cadastrado com sucesso faça login para continuar";
        }
        catch (Exception $e)
        {
            $_SESSION['msg'] = "Email não enviado, tente novamente Error:$e {$mail->ErrorInfo} ";
        }
    }
}

?>