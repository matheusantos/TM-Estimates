<?php

/* ! Operações na tabela Ambiente */

class Application_Model_Estimaresforco {
    
    public function db_inserir(array $request, $estima) {
        $my_format = date('Y-m-d');

        $dao = new Application_Model_DbTable_EstimativasEsforco();
        $dados = array(
            'projeto_idProjeto' => $request['Projeto'],
            'Estimativa' => $estima,
            'Data' => $my_format
        );
        return $dao->insert($dados);
    }

    public function esforco_select($id) {
        $dao = new Application_Model_DbTable_EstimativasEsforco();
        $select = $dao->select()
                ->from($dao, 'Estimativa')
                ->where('projeto_idProjeto' . '= ?', $id);

        return $dao->fetchAll($select)->toArray();
    }

    public function db_delete($id) {
        $dao = new Application_Model_DbTable_EstimativasEsforco();
        $where = $dao->getAdapter()->quoteInto("idEstimativasEsforco = ?", $id);
        $dao->delete($where);
    }

    public function est_delete($id) {
        $dao = new Application_Model_DbTable_EstimativasEsforco();
        $where = $dao->getAdapter()->quoteInto("projeto_idProjeto = ?", $id);
        $dao->delete($where);
    }

}
