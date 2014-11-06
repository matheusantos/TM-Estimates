<?php
/*! Operações na tabela Projeto */
class Application_Model_Projeto extends Zend_Db_Table_Abstract {

    protected $_name = "projeto";
    protected $_primary = "idProjeto";

    public function inserir(array $request, $id) {
        $my_format = date('Y-m-d H:i:s');

        $dados = array(
            'Titulo' => $request['projetoTitulo'],
//            'DataCriacao' => $request['projetoDataCriacao'],
//            'DataFininalizacao' => $request['projetoDataFim'],
            'Categoria' => $request['projetoCategoria'],
            'Situacao' => $request['projetoSituacao'],
            'UltimaAtualizacao' => $my_format,
            'Cliente_idCliente' => $id
        );
        return $this->insert($dados);
    }

    public function db_select($where = null, $valor = null, $order = null, $limit = null) {
        $select = $this->select()
                ->from($this)
                ->order($order)
                ->limit($limit);

        if (!is_null($where)) {
            $select->where($where . '= ?', $valor);
            //$select->where($where.'='. $valor);
        }
        return $this->fetchAll($select)->toArray();
    }
}
