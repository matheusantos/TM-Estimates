<?php

/* ! Operações na tabela Ambiente */

class Application_Model_Estimarprazo extends Zend_Db_Table_Abstract{

    protected $_name = "estimativasprazo";
    protected $_primary = "idEstimativasPrazo";

    public function db_inserir(array $request, $prazo) {
        $my_format = date('Y-m-d');
        
        $dados = array(
            'projeto_idProjeto' => $request['Projeto'],
            'Estimativa' => $prazo,
            'Data' => $my_format
        );
        echo $prazo;
        die;
        return $this->insert($dados);
    }

    public function db_delete($id) {
        $where = $this->getAdapter()->quoteInto("idEstimativasPrazo = ?", $id);
        $this->delete($where);
    }

    public function est_delete($id) {
        $where = $this->getAdapter()->quoteInto("projeto_idProjeto = ?", $id);
        $this->delete($where);
    }

}
