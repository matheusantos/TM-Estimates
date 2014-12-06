<?php

/* ! Operações na tabela Projeto */

class Application_Model_Projeto {

    public function inserir(array $request, $id) {
        $my_format = date('Y-m-d H:i:s');

        $dao = new Application_Model_DbTable_Projeto();
        $dados = array(
            'Titulo' => $request['projetoTitulo'],
            'DataCriacao' => $request['projetoDataCriacao'],
            'DataFininalizacao' => $request['projetoDataFim'],
            'Categoria' => $request['projetoCategoria'],
            'Situacao' => $request['projetoSituacao'],
            'UltimaAtualizacao' => $my_format,
            'Cliente_idCliente' => $id
        );
        return $dao->insert($dados);
    }

    public function db_select($where = null, $valor = null, $order = null, $limit = null) {
        $dao = new Application_Model_DbTable_Projeto();
        $select = $dao->select()
                ->from($dao)
                ->order($order)
                ->limit($limit);

        if (!is_null($where)) {
            $select->where($where . '= ?', $valor);
        }
        return $dao->fetchAll($select)->toArray();
    }

    /* public function ed_select($id){
      $db = Zend_Db_Table_Abstract::getDefaultAdapter();
      $select = $db->select()
      ->from('projeto')
      ->where('idProjeto='.$id);
      return $db->fetchAll($select);
      } */

    public function db_update(array $request) {

        $my_format = date('Y-m-d H:i:s');

        $dao = new Application_Model_DbTable_Projeto();
        $dados = array(
            'Titulo' => $request['projetoTitulo'],
//            'DataCriacao' => $request['projetoDataCriacao'],
//            'DataFininalizacao' => $request['projetoDataFim'],
            'Categoria' => $request['projetoCategoria'],
            'Situacao' => $request['projetoSituacao'],
            'UltimaAtualizacao' => $my_format,
        );

        $where = $dao->getAdapter()->quoteInto('idProjeto = ?', $request['id']);

        $dao->update($dados, $where);
    }

    public function db_delete($id) {
        $dao = new Application_Model_DbTable_Projeto();
        $where = $dao->getAdapter()->quoteInto("idProjeto = ?", $id);
        $dao->delete($where);
    }

}
