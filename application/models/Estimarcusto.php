<?php
/*! Operações na tabela Ambiente */
class Application_Model_Estimarcusto extends Zend_Db_Table_Abstract {

    protected $_name = "estimativascusto";
    protected $_primary = "idestimativasCusto";

    public function inserir(array $request) {
        $my_format = date('Y-m-d H:i:s');
        
        $dados = array(
            'projeto_idProjeto' => $request['Projeto'],
            'Estimativa' => '0',
            'Data' => $my_format
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

    public function find($id) {
        $arr = $this->find($id)->toArray();
        return $arr[0];
    }


    public function db_delete($id) {
        $where = $this->getAdapter()->quoteInto("idestimativasCusto = ?", $id);
        $this->delete($where);
    }

}
