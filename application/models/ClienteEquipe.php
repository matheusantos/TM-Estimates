<?php

class Application_Model_ClienteEquipe {

    public function db_select($where = null, $valor = null, $order = null, $limit = null) {
        $dao = new Application_Model_DbTable_Clienteequipe();
        $select = $dao->select()
                ->from($dao)
                ->order($order)
                ->limit($limit);

        if (!is_null($where)) {
            $select->where($where . '= ?', $valor);
        }
        return $dao->fetchAll($select)->toArray();
    }

    public function db_find($id, $id2) {
        $dao = new Application_Model_DbTable_Clienteequipe();
        $arr = $dao->find($id, $id2)->toArray();
        return $arr;
    }

}
