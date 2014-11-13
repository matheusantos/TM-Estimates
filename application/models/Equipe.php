<?php
/*! Operações com a tabela Equipe */
class Application_Model_Equipe extends Zend_Db_Table_Abstract {

    protected $_name = "equipe";
    protected $_primary = "Recursos_idRecursos";

    public function inserir(array $request) {
        $dados = array(
            'Projeto_idProjeto' => $request['Projeto'],
            'Recursos_idRecursos' => $request['Recurso'],
            'QtRecursos' => $request['QtdRec'],
        );
        return $this->insert($dados);
    }

    public function db_select($where = null, $valor = null, $order = null, $limit = null) {
        $select = $this->select()
                        ->from($this)
                        ->order($order)
                        ->limit($limit);
		
        if (!is_null($where)) {
            $select->where($where.'= ?', $valor);
            //$select->where($where.'='. $valor);
        }
        return $this->fetchAll($select)->toArray();
    }
    
    public function db_update(array $request) {
        
         $dados = array(
            'Projeto_idProjeto' => $request['Projeto'],
            'Recursos_idRecursos' => $request['Recurso'],
            'QtRecursos' => $request['QtdRec'],
        );
        
        $where = $this->getAdapter()->quoteInto('Projeto_idProjeto = ?', $request['id']);
        
        $this->update($dados, $where);
    }

}
