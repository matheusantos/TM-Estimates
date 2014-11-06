<?php

class Application_Model_DetalharCusto extends Zend_Db_Table_Abstract {

    protected $_name = "custofase";
    protected $_primary = "idCustoFase";

    public function inserir(array $request) {
        $dados = array(
            'Descricao' => $request['Desc'],
            'ValorPrevisto' => $request['ValorPrev'],
            'ValorEfetivo' => $request['ValorEf'],
            'fase_idFase' => "2"
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
            'Descricao' => $request['Desc'],
            'ValorPrevisto' => $request['ValorPrev'],
            'ValorEfetivo' => $request['ValorEf'],
        );
        $where = $this->getAdapter()->quoteInto("contato_id = ?", $request['contato_id']);
        $this->update($dados, $where);
    }

    public function delete($id) {
        $where = $this->getAdapter()->quoteInto("contato_id = ?", $id);
        $this->delete($where);
    }

}
