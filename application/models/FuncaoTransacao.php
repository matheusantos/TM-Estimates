<?php
/*! Operações na tabela Ambiente */
class Application_Model_FuncaoTransacao extends Zend_Db_Table_Abstract {

    protected $_name = "funcaotransacao";
    protected $_primary = "idFuncaoTransacao";
    
    public function inserir(array $request) {           
        $dados = array(
            'Funcao' => $request['funcao'],
            'Descricao' => $request['Descri'],
            'qtdArquivoRef' => $request['ArqRef'],
            'qtdTipoDados' => $request['TipDados'],
            'projeto_idProjeto' => $request['Projeto'],
            //'Complexidade' => $Complexidade,
            //'PF' => $pfDados,
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
            'qtdArquivoRef' => $request['ArqRef'],
            'qtdTipoDados' => $request['TipDados'],
            //'Complexidade' => $Complexidade,
            //'PF' => $pfDados,
        );
        $where = $this->getAdapter()->quoteInto("idFuncaoTransacao = ?", $request['id']);
        $this->update($dados, $where);
    }

    public function db_delete($id) {
        $where = $this->getAdapter()->quoteInto("idFuncaoTransacao = ?", $id);
        $this->delete($where);
    }

}
