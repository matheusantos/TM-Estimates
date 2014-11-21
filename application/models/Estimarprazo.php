<?php

/* ! Operações na tabela Ambiente */

class Application_Model_Estimarprazo extends Zend_Db_Table_Abstract{

    protected $_name = "estimativasprazo";
    protected $_primary = "idEstimativasPrazo";

    public function db_inserir(array $request, $prazo) {
        $my_format = date('Y-m-d');
        
        $dao = new Application_Model_DbTable_EstimativasPrazo();
        $dados = array(
            'projeto_idProjeto' => $request['Projeto'],
            'Estimativa' => $prazo,
            'Data' => $my_format
        );
<<<<<<< HEAD
        return $dao->insert($dados);
=======
        echo $prazo;
        die;
        return $this->insert($dados);
>>>>>>> origin/master
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
