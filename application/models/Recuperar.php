<?php
/*! Operações na tabela Esqueseu Senha */
class Application_Model_EsqueseuSenha extends Zend_Db_Table_Abstract {

    protected $_name = "recuperarsenha";
    protected $_primary = "idRecuperar";

    public function inserir($hash, $data_time, $id) {
        $dados = array(
            'Hash' => $hash,
            'Data_hora' => $data_time,
            'Utilizada' => FALSE,
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

    public function db_update($hash, $valor) {
        $dados = array(
            'Utilizada' => $valor
        );
        $where = $this->getAdapter()->quoteInto("Hash = ?", $hash);
        $this->update($dados, $where);
    }

}
