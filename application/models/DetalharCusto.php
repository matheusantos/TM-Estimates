<?php
/*! Operações na tabela DetalharCusto */
class Application_Model_DetalharCusto extends Zend_Db_Table_Abstract {

    protected $_name = "custofase";
    protected $_primary = "idCustoFase";

    public function db_inserir(array $request) {
        $dados = array(
            'Descricao' => $request['Desc'],
            'ValorPrevisto' => $request['ValorPrev'],
            'ValorEfetivo' => $request['ValorEf'],
            'fase_idFase' => $request['Fase']
        );
        return $this->insert($dados);
    }

    public function db_select($where = null, $order = null, $limit = null) {
        $select = $this->select()
                ->from($this)
                ->order($order)
                ->limit($limit);

        if (!is_null($where)) {
            $select->where($where);
        }
        return $this->fetchAll($select)->toArray();
    }

}
