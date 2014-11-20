<?php
/*! Operações na tabela Ambiente */
class Application_Model_Estimarprodutividade {

    protected $_name = "estimativasprodutividade";
    protected $_primary = "idEstimativasProdutividade";

    public function inserir(array $request) {
        $my_format = date('Y-m-d');
        
        $dao = new Application_Model_DbTable_ViewEstimativasEsforco();
        $dados = array(
            'projeto_idProjeto' => $request['Projeto'],
            'Estimativa' => '0',
            'Data' => $my_format
        );
        return $dao->insert($dados);
    }

    public function db_delete($id) {
        $dao = new Application_Model_DbTable_ViewEstimativasEsforco();
        $where = $dao->getAdapter()->quoteInto("idEstimativasProdutividade = ?", $id);
        $dao->delete($where);
    }

}
