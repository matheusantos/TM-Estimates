<?php

/* ! Operações com a tabela Fase */

class Application_Model_Fase extends Zend_Db_Table_Abstract {

    protected $_name = "fase";
    protected $_primary = "idFase";

    public function inserir(array $request, $id) {
        $dados = array(
            'Descricao' => $request['Desc'],
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
            $select->where($where . '= ?', $valor);
            //$select->where($where.'='. $valor);
        }
        return $this->fetchAll($select)->toArray();
    }

    public function db_update(array $request) {
        $dados = array(
            'Descricao' => $request['Desc'],
        );
        $where = $this->getAdapter()->quoteInto("idFase = ?", $request['id']);
        $this->update($dados, $where);
    }

    public function db_delete($id) {
        $where = $this->getAdapter()->quoteInto("idFase = ?", $id);
        $this->delete($where);
    }

}
