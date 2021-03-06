<?php
/**
 * Controlador do Login
 * 
 * @author Jonathas Assunção
 * @version 0.0.1
 * 
 * =================================================================
 * date - 02/10/2018 - @version 0.0.1
 * description: Versão inicial do arquivo, 
 *              criação do método logarAction que 
 *              autentica o usuário e redireciona para o HomeController (Página Home do sistema);
 * =================================================================
 * 
 * Dir  - Controllers
 * File - LoginController.php
 */
 
 //Inclui a classe model de negócio
 require_once 'Models/LoginModel.php';

 class LoginController{

    /**
     * Exibe a tela de login
     * 
     */
    public function exibirAction(){
        //Renderiza a página de Login
        $view = new ViewMaster('Views/Login/loginView.phtml');
        //Retorna para o navegador a página HTML à ser exibida.
        $view->showHTMLPag();
        
    }

    public function loginAction(){
        
        //Instancia a classe Model dos Contatos
        $usuario = new LoginModel();

        //Captura as variaveis de login e passa para o Model Tratar
        $usuario->setUsuario($_POST['usuario']);
        $usuario->setSenha($_POST['senha']);
        $usuario->setCaptcha($_POST['g-recaptcha-response']);

        //Verifica se está autenticado
        if($usuario->isAutenticado()){ //Está autenticado 
              //Usuário autenticado com sucesso
              //Redireciona para próxima página
              echo "Logado com sucesso. <br/>Redirecionando..."; 

              //Define Controller  e Action para a página a ser chamada
              //Redireciona para a página Index (Recarrega  a página)
              ControllerMaster::setRequest('Home', 'listar');  
              ControllerMaster::redirect(); 

        }else{ //Não está autenticado
            //Pega a mensagem de Erro e Executa o exibirAction
            echo $usuario->getMensagem(); //Retorna a mensagem de erro
        }
    }


    /**
     * Desloga do sistema e exclui as seções
     * 
     */
    public function logoffAction(){        
        LoginModel::sair();            
    }        
    
 }
?>