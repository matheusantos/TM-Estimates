<?php

/* ! Operações na tabela Ambiente */

class Application_Model_Estimarcusto {

    public function db_inserir(array $request, $custo) {
        $my_format = date('Y-m-d');

        $dao = new Application_Model_DbTable_EstimavasCusto();
        $dados = array(
            'projeto_idProjeto' => $request['Projeto'],
            'Estimativa' => $custo,
            'Data' => $my_format
        );
        return $dao->insert($dados);
    }

    public function db_delete($id) {
        $dao = new Application_Model_DbTable_EstimavasCusto();
        $where = $dao->getAdapter()->quoteInto("idestimativasCusto = ?", $id);
        $dao->delete($where);
    }
    
    public function est_delete($id) {
        $dao = new Application_Model_DbTable_EstimavasCusto();
        $where = $dao->getAdapter()->quoteInto("projeto_idProjeto = ?", $id);
        $dao->delete($where);
    }


}
