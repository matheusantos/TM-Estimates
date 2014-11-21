<?php

/* ! Operações na tabela Ambiente */

class Application_Model_Estimarprazo extends Zend_Db_Table_Abstract{

    protected $_name = "estimativasprazo";
    protected $_primary = "idEstimativasPrazo";

    public function db_inserir(array $request) {
        $my_format = date('Y-m-d');
        
        $dao = new Application_Model_DbTable_EstimativasPrazo();
        $dados = array(
            'projeto_idProjeto' => $request['Projeto'],
            'Estimativa' => '0',
            'Data' => $my_format
        );
        return $dao->insert($dados);
    }

    public function db_delete($id) {
        $dao = new Application_Model_DbTable_EstimativasPrazo();
        $where = $dao->getAdapter()->quoteInto("idEstimativasPrazo = ?", $id);
        $dao->delete($where);
    }

    public function est_delete($id) {
        $dao = new Application_Model_DbTable_EstimativasPrazo();
        $where = $dao->getAdapter()->quoteInto("projeto_idProjeto = ?", $id);
        $dao->delete($where);
    }

}
