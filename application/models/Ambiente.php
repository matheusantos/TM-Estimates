<?php

class Application_Model_Ambiente extends Zend_Db_Table_Abstract {

    protected $_name = "ambiente";
    protected $_primary = "idAmbiente";

    public function inserir(array $request, $id) {
        $dados = array(
            'Linguagem' => $request['Linguagem'],
            'Esforco' => $request['HorPes'],
            'Produtividade' => $request['PesH'],
            'cliente_idCliente' => $id
        );
        return $this->insert($dados);
    }

    public function db_select($where = null, $valor = null, $order = null, $limit = null) {
        $select = $this->select()
                        ->from($this)
                        ->order($order)
                        ->limit($limit);
		
        if (!is_null($where)) {
            $select->where($where.'= ?', $valor);
            //$select->where($where.'='. $valor);
        }
        return $this->fetchAll($select)->toArray();
    }

    public function find($id) {
        $arr = $this->find($id)->toArray();
        return $arr[0];
    }

    public function update(array $request) {
        $dados = array(
            'Linguagem' => $request['Linguagem'],
            'Esforco' => $request['HorPes'],
            'Produtividade' => $request['PesH'],
        );
        $where = $this->getAdapter()->quoteInto("contato_id = ?", $request['contato_id']);
        $this->update($dados, $where);
    }

    public function delete($id) {
        $where = $this->getAdapter()->quoteInto("contato_id = ?", $id);
        $this->delete($where);
    }

}
