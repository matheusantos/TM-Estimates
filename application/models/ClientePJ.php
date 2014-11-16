<?php
/*! Operações na tabela ClientePJ */
class Application_Model_ClientePJ extends Zend_Db_Table_Abstract {

    protected $_name = "clientepj";
    protected $_primary = "idCNPJ";

    public function inserir(array $request, $id) {
        //$data = date('Y-m-d H:i:s');
        
        $dados = array(
            'NomeFantasia' => $request['nomeFant'],
            'Telefone' => $request['tel'],
            'cliente_idCliente'=> $id,
            'CNPJ' => $request['cnpj']
        );
        return $this->insert($dados);
    }

    public function db_select($where = null, $order = null, $limit = null) {
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
