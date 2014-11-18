<?php
/*! Operações na tabela Ambiente */
class Application_Model_FuncaoDados extends Zend_Db_Table_Abstract {

    protected $_name = "funcaodados";
    protected $_primary = "idFuncaoDados";

    public function inserir(array $request) {
        
        $dados = array(
            'Funcao' => $request['funcao'],
            'Descricao' => $request['Descri'],
            'qtdTiposRegistro' => $request['TipRegis'],
            'qtdTiposDados' => $request['TipDados'],
            'projeto_idProjeto' => $request['Projeto'],
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

    public function db_update(array $request) {
        $dados = array(
            'Funcao' => $request['funcao'],
            'Descricao' => $request['Descri'],
            'qtdTiposRegistro' => $request['TipRegis'],
            'qtdTiposDados' => $request['TipDados'],
        );
        $where = $this->getAdapter()->quoteInto("idFuncaoDados = ?", $request['id']);
        $this->update($dados, $where);
    }

    public function db_delete($id) {
        $where = $this->getAdapter()->quoteInto("idFuncaoDados = ?", $id);
        $this->delete($where);
    }

}
