<?php

class Application_Model_Projeto extends Zend_Db_Table_Abstract {

    protected $_name = "projeto";
    protected $_primary = "idProjeto";
//
//    public function inserir(array $dados) {
//        $in = array(
//            "idCidade" => "4",
//            "Nome" => $dados["exampleInputProj"],
//            "UF" => $dados["exampleInputFunc"]
//        );
//
//        return $this->insert($in);
//    }
//
    public function insert(array $request) {

        $dados = array(
            'contato_nome' => $request['contato_nome'],
            'contato_telefone' => $request['contato_telefone'],
            'contato_email' => $request['contato_email']
        );
        return $this->insert($dados);
    }

    public function select($where = null, $order = null, $limit = null) {
        $dao = new Application_Model_DbTable_Contato();
        $select = $dao->select()->from($dao)->order($order)->limit($limit);
        if (!is_null($where)) {
            $select->where($where);
        }
        return $dao->fetchAll($select)->toArray();
    }

    public function find($id) {
        $dao = new Application_Model_DbTable_Contato();
        $arr = $dao->find($id)->toArray();
        return $arr[0];
    }

    public function update(array $request) {
        $dao = new Application_Model_DbTable_Contato();
        $dados = array(
            'contato_nome' => $request['contato_nome'],
            'contato_telefone' => $request['contato_telefone'],
            'contato_email' => $request['contato_email']
        );
        $where = $dao->getAdapter()->quoteInto("contato_id = ?", $request['contato_id']);
        $dao->update($dados, $where);
    }

    public function delete($id) {
        $dao = new Application_Model_DbTable_Contato();
        $where = $dao->getAdapter()->quoteInto("contato_id = ?", $id);
        $dao->delete($where);
    }

}
