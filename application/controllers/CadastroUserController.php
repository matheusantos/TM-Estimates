<?php

/* ! Controler Cadastro de Usuario */

class CadastroUserController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        // action body
    }

    public function pjAction() {
        // action body
    }

    public function cadastrarAction() {
        $email = $_POST["email"];
        $senha = $_POST["senha"];
        $senha2 = $_POST["ConfSenha"];

        if ($email == '') {
            echo 'Preencha o campo e-mail!';
            die;
        } else {
            if ($senha == '' || $senha2 == '') {
                echo "preencha a senha!";
                die;
            } else {
                if ($senha != $senha2) {
                    echo "As senhas não conferem!";
                    die;
                } else {
                    $dados = $this->_getAllParams();

                    $cliente = new Application_Model_Cliente();

                    $email = $cliente->db_select('Email', $dados['email']);

                    if (!empty($email)) {
                        echo "Arrumar um jeito de retorna Email ja cadastrado no form";
                        die;
                    }

                    $CEP = $_POST["cep"];
                    $Cidade = $_POST["cidade"];
                    $Estado = $_POST["estado"];
                    $Rua = $_POST["rua"];
                    $Bairro = $_POST["bairro"];
                    
                    if($CEP == '' || $Cidade == '' || $Estado == '' || $Rua == '' || $Bairro == ''){
                        echo 'Preencha todos os campos de endereco!';
                        die;
                    }
                    else{

                    $radio = $dados['radio_box'];
                    if ($radio == "pf") {
                        $Nome = $_POST["nome"];
                        $Sobrenome = $_POST["sobrenome"];
                        $RG = $_POST["rg"];
                        $CPF = $_POST["cpf"];
                        $DatNasc = $_POST["datNasc"];
                        $Sexo = $_POST["sexo"];

                        if ($Nome == '' || $Sobrenome == '' || $RG == '' || $CPF == '' || $DatNasc == 0000 - 00 - 00 || $Sexo == '') {
                            echo "Preencha todos os campos de identificacao!";
                            die;
                        } else
                            $model = new Application_Model_ClientePF();
                    } else {
                        $CNPJ = $_POST["cnpj"];
                        $RazSoc = $_POST["razSocial"];
                        $NomeFant = $_POST["nomeFant"];

                        if ($CNPJ == '' || $RazSoc == '' || $NomeFant == '') {
                            echo "Preencha todos os campos de identificacao!";
                            die;
                        } else
                            $model = new Application_Model_ClientePJ();
                    }
                    $id = $cliente->inserir($dados);
                    $model->inserir($dados, $id);

                    $this->_redirect("/login");
                    }
                }
            }
        }
    }

}
