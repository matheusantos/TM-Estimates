<?php

/* ! Operações na tabela Ambiente */

class Application_Model_Estimarprodutividade {

    public function inserir(array $request, $estimativa) {
        $my_format = date('Y-m-d');

        $dao = new Application_Model_DbTable_EstimativasProdutividade();
        $dados = array(
            'projeto_idProjeto' => $request['Projeto'],
            'Estimativa' => $estimativa,
            'Data' => $my_format
        );
        return $dao->insert($dados);
    }

    public function select_prod($id) {
        $dao = new Application_Model_DbTable_EstimativasProdutividade();
        $select = $dao->select()
                ->from($dao, 'Estimativa')
                ->where('projeto_idProjeto' . '= ?', $id);

        return $dao->fetchAll($select)->toArray();
    }

    public function db_delete($id) {
        $dao = new Application_Model_DbTable_EstimativasProdutividade();
        $where = $dao->getAdapter()->quoteInto("idEstimativasProdutividade = ?", $id);
        $dao->delete($where);
    }

    public function est_delete($id) {
        $dao = new Application_Model_DbTable_EstimativasProdutividade();
        $where = $dao->getAdapter()->quoteInto("projeto_idProjeto = ?", $id);
        $dao->delete($where);
    }

}
