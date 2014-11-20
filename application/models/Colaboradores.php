<?php
/*! Operações na tabela Ambiente */
class Application_Model_Colaboradores extends Zend_Db_Table_Abstract {

    protected $_name = "colaboradores";
    protected $_primary = "idColaboradores";

    public function inserir(array $request, $id) {
        $dados = array(
            'Nome' => $request['Nome'],
            'Email' => $request['Email'],
            'idProjeto' => $id
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

    public function db_update(array $request) {
        $dados = array(
            'Nome' => $request['Nome'],
            'Email' => $request['Email'],
        );
        $where = $this->getAdapter()->quoteInto("idColaboradores = ?", $request['id']);
        $this->update($dados, $where);
    }

    public function db_delete($id) {
        $where = $this->getAdapter()->quoteInto("idColaboradores = ?", $id);
        $this->delete($where);
    }

}
