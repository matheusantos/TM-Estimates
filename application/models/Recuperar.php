<?php
/*! Operações na tabela Recuperar Senha */
class Application_Model_Recuperar {

    public function db_insert($hash, $data_time, $id) {
        $dao = new Application_Model_DbTable_Recuperarsenha();
        $dados = array(
            'Hash' => $hash,
            'Data_hora' => $data_time,
            'Utilizada' => FALSE,
            'cliente_idCliente' => $id
        );
        return $dao->insert($dados);
    }

    public function db_select($where = null, $valor = null, $order = null, $limit = null) {
        $dao = new Application_Model_DbTable_Recuperarsenha();
        $select = $dao->select()
                        ->from($dao)
                        ->order($order)
                        ->limit($limit);
		
        if (!is_null($where)) {
            $select->where($where.'= ?', $valor);
        }
        return $dao->fetchAll($select)->toArray();
    }

    public function db_update($hash, $valor) {
        $dao = new Application_Model_DbTable_Recuperarsenha();
        $dados = array(
            'Utilizada' => $valor
        );
        $where = $dao->getAdapter()->quoteInto("Hash = ?", $hash);
        $dao->update($dados, $where);
    }

}
