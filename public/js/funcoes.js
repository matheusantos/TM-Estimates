/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function setPJ() {
    location.href = "http://localhost/TM-Estimates/public/cadastro-user/pj";
}

function setPF() {
    location.href = "http://localhost/TM-Estimates/public/cadastro-user/index";
}

function setVisaE() {
    location.href = "http://localhost/TM-Estimates/public/vendas/pagamento-debito";
}

function setVisa() {
    location.href = "http://localhost/TM-Estimates/public/vendas/pagamento";
}

function setBoleto() {
    location.href = "http://localhost/TM-Estimates/public/vendas/pagamento-boleto";
}

function setMaster() {
    location.href = "http://localhost/TM-Estimates/public/vendas/pagamento-master";
}

function setHiper() {
    location.href = "http://localhost/TM-Estimates/public/vendas/pagamento-hiper";
}

function setAmerica() {
    location.href = "http://localhost/TM-Estimates/public/vendas/pagamento-america";
}

function setPag() {
    location.href = "http://localhost/TM-Estimates/public/vendas/pagamento";
}

function setCancel() {
    location.href = "http://localhost/TM-Estimates/public/vendas";
}

function setIni() {
    location.href = "http://localhost/TM-Estimates/public";
}

function validarSenha() {
    var senha = cadastro.senha.value;
    var rep_senha = cadastro.ConfSenha.value;
    
    if(senha != rep_senha){
        alert("As senhas não conferem!");
        document.bgColor='red';
    }
}
