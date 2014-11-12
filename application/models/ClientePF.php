<?php
/*! Interações com a tabela ClientePF */
class Application_Model_ClientePF extends Zend_Db_Table_Abstract {

    protected $_name = "clientepf";
    protected $_primary = "idCPF";

    public function inserir(array $request, $id) {
        //$data = date('Y-m-d H:i:s');
        
        $dados = array(
            'Nome' => $request['nome'],
            'Sobrenome' => $request['sobrenome'],
            'Telefone' => $request['tel'],
            'datNasc' => $request['datNasc'],
            'Sexo' => $request['sexo'],
            'cliente_idCliente' => $id,
            'CPF' => $request['cpf'],
            'RG' => $request['rg']
        );
        return $this->insert($dados);
    }

    public function _select($where = null, $order = null, $limit = null) {
        $select = $this->select()
                        ->from($this)
                        ->order($order)
                        ->limit($limit);
		
        if (!is_null($where)) {
            $select->where($where);
        }
        return $this->fetchAll($select)->toArray();
    }

}
