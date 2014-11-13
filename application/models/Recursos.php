<?php
/*! Operações na tabela Recursos */
class Application_Model_Recursos extends Zend_Db_Table_Abstract {

    protected $_name = "recursos";
    protected $_primary = "idRecursos";

    public function db_inserir(array $request, $id) {
        $dados = array(
            'Descricao' => $request['descricao'],
            'Carga_horaria' => $request['carga_horaria'],
            'Custo' => $request['custo'],
            'cliente_idCliente' => $id
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
            'Descricao' => $request['descricao'],
            'Carga_horaria' => $request['carga_horaria'],
            'Custo' => $request['custo'],
        );
        
        $where = $this->getAdapter()->quoteInto('idRecursos = ?', $request['id']);
        
        $this->update($dados, $where);
    }
    
        public function db_delete($id) {
        $where = $this->getAdapter()->quoteInto("idRecursos = ?", $id);
        $this->delete($where);
    }

}
