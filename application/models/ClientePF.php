<?php
/*! Interações com a tabela ClientePF */
class Application_Model_ClientePF extends Zend_Db_Table_Abstract {

    protected $_name = "clientepf";
    protected $_primary = "idCPF";

    public function inserir(array $request, $id) {
        $data = date('Y-m-d H:i:s');
        
        $dados = array(
            'Nome' => $request['nome'],
            'Sobrenome' => $request['sobrenome'],
            'Telefone' => $request['tel'],
            'datNasc' => $request['datNasc'],
            'Sexo' => $request['sexo'],
            'dataCadastro' => $data,
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

    public function find($id) {
        $arr = $this->find($id)->toArray();
        return $arr[0];
    }

    public function update(array $request) {
        $dados = array(
            'Descricao' => $request['descricao'],
            'Carga_horaria' => $request['carga_horaria'],
            'Custo' => $request['custo']
        );
        $where = $this->getAdapter()->quoteInto("contato_id = ?", $request['contato_id']);
        $this->update($dados, $where);
    }

    public function delete($id) {
        $where = $this->getAdapter()->quoteInto("contato_id = ?", $id);
        $this->delete($where);
    }

}
