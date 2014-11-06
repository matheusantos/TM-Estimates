<?php

class Application_Model_Projeto extends Zend_Db_Table_Abstract {

    protected $_name = "projeto";
    protected $_primary = "idProjeto";

    public function inserir(array $request) {
        $my_format = date('Y-m-d H:i:s');
        
        $dados = array(
            'Titulo' => $request['projetoTitulo'],
            'DataCriacao' => $request['projetoDataCriacao'],
            'DataFininalizacao' => $request['projetoDataFim'],
            'Categoria' => $request['projetoCategoria'],
            'Situacao' => $request['projetoSituacao'],
            'UltimaAtualizacao' => $my_format,
            'Cliente_idCliente' => "1"
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
            'Titulo' => $request['projetoTitulo'],
            'DataCriacao' => $request['projetoDataCriacao'],
            'DataFininalizacao' => $request['proejtoDataFim'],
            'Categoria' => $request['projetoCategoria'],
            'Situacao' => $request['projetoSituacao'],
            'UltimaAtualizacao' => $my_format,
            'Cliente_idCliente' => "0"
        );
        $where = $this->getAdapter()->quoteInto("contato_id = ?", $request['contato_id']);
        $this->update($dados, $where);
    }

    public function delete($id) {
        $where = $this->getAdapter()->quoteInto("contato_id = ?", $id);
        $this->delete($where);
    }

}
