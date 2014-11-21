<?php

/* ! Operações na tabela Ambiente */

class Application_Model_Estimaresforco extends Zend_Db_Table_Abstract {

    public function db_inserir(array $request, $estima) {
        $my_format = date('Y-m-d');

        $dao = new Application_Model_DbTable_ViewEstimativasEsforco();
        $dados = array(
            'projeto_idProjeto' => $request['Projeto'],
            'Estimativa' => $estima,
            'Data' => $my_format
        );
        return $dao->insert($dados);
    }

    public function esforco_select($id) {
        $select = $this->select()
                ->from($this, 'Estimativa')
                ->where('projeto_idProjeto' . '= ?', $id);

        return $this->fetchAll($select)->toArray();
    }

    public function db_delete($id) {
        $dao = new Application_Model_DbTable_ViewEstimativasEsforco();
        $where = $dao->getAdapter()->quoteInto("idEstimativasEsforco = ?", $id);
        $dao->delete($where);
    }

    public function est_delete($id) {
        $where = $this->getAdapter()->quoteInto("projeto_idProjeto = ?", $id);
        $this->delete($where);
    }

}
