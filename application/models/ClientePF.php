<?php

/* ! Interações com a tabela ClientePF */

class Application_Model_ClientePF extends Zend_Db_Table_Abstract {

    protected $_name = "clientepf";
    protected $_primary = "idCPF";

    public function inserir(array $request, $id) {
        //$data = date('Y-m-d H:i:s');

        $dados = array(
            'Nome' => $request['nome'],
            'Sobrenome' => $request['sobrenome'],
            'Telefone' => $request['tel'],
            'Celular' => $request['cel'],
            'datNasc' => $request['datNasc'],
            'Sexo' => $request['sexo'],
            'cliente_idCliente' => $id,
            'CPF' => $request['cpf'],
            'RG' => $request['rg']
        );
        return $this->insert($dados);
    }

    public function db_select($id) {
        $db = Zend_Db_Table_Abstract::getDefaultAdapter();
        $select = $db->select()
                ->from('clientepf')
                ->where('cliente_idCliente=' . $id);
        return $db->fetchAll($select);
    }
    
    public function db_update(array $request) {
        $dados = array(
            'Nome' => $request['nome'],
            'Sobrenome' => $request['sobrenome'],
            'Telefone' => $request['tel'],
            'Celular' => $request['cel'],
            'datNasc' => $request['datNasc'],
            'Sexo' => $request['sexo'],
            'CPF' => $request['cpf'],
            'RG' => $request['rg']
        );
        $where = $this->getAdapter()->quoteInto("cliente_idCliente = ?", $request['id']);
        $this->update($dados, $where);
    }

}
