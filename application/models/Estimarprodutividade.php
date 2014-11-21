<?php
/*! Operações na tabela Ambiente */
class Application_Model_Estimarprodutividade extends Zend_Db_Table_Abstract{

    protected $_name = "estimativasprodutividade";
    protected $_primary = "idEstimativasProdutividade";

    public function inserir(array $request, $estimativa) {
        $my_format = date('Y-m-d');
        
        $dao = new Application_Model_DbTable_ViewEstimativasProdutividade();
        $dados = array(
            'projeto_idProjeto' => $request['Projeto'],
            'Estimativa' => $estimativa,
            'Data' => $my_format
        );
        return $dao->insert($dados);
    }
    
    public function select_prod($id) {
        $select = $this->select()
        ->from($this, 'Estimativa')
        ->where('projeto_idProjeto' . '= ?', $id);

        return $this->fetchAll($select)->toArray();
    }

    public function db_delete($id) {
        $where = $this->getAdapter()->quoteInto("idEstimativasProdutividade = ?", $id);
        $this->delete($where);
    }
    
        public function est_delete($id) {
        $where = $this->getAdapter()->quoteInto("projeto_idProjeto = ?", $id);
        $this->delete($where);
    }

}
