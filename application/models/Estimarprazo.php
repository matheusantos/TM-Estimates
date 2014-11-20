<?php
/*! Operações na tabela Ambiente */
class Application_Model_Estimarprazo {

    public function db_inserir(array $request) {
        $my_format = date('Y-m-d');
        
        $dao = new Application_Model_DbTable_EstimavasCusto();
        $dados = array(
            'projeto_idProjeto' => $request['Projeto'],
            'Estimativa' => '0',
            'Data' => $my_format
        );
        return $dao->insert($dados);
    }

    public function db_delete($id) {
        $dao = new Application_Model_DbTable_EstimavasCusto();
        $where = $dao->getAdapter()->quoteInto("idEstimativasPrazo = ?", $id);
        $dao->delete($where);
    }

}
