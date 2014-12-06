<?php

class Application_Model_ViewEstimativasProdutividade
{
    public function db_select($where = null, $valor = null ,$order = null, $limit = null) {
        $dao = new Application_Model_DbTable_ViewEstimativasProdutividade();
        $select = $dao->select()->from($dao)->order($order)->limit($limit);
        if (!is_null($where)) {
            $select->where($where . '= ?', $valor);
        }
        return $dao->fetchAll($select)->toArray();
    }

}

