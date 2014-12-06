<?php

class Application_Model_PontosFuncao {

    public function inserir(array $request, $pfTotal) {

        $my_format = date('Y-m-d H:i:s');

        $dao = new Application_Model_DbTable_PontosFuncao();
        $dados = array(
            'Data' => $my_format,
            'Estimativa' => $pfTotal,
            'projeto_idProjeto' => $request['Projeto'],
        );
        return $dao->insert($dados);
    }

    public function db_delete($id) {
        $dao = new Application_Model_DbTable_PontosFuncao();
        $where = $dao->getAdapter()->quoteInto("idPontosFuncao = ?", $id);
        $dao->delete($where);
    }

    
    public function pf_select($id) {
        $dao = new Application_Model_DbTable_PontosFuncao();
        $select = $dao->select()
                ->from($dao, 'Estimativa')
                ->where('projeto_idProjeto' . '= ?', $id);

        return $dao->fetchAll($select)->toArray();
    }

    public function pf_delete($id) {
        $dao = new Application_Model_DbTable_PontosFuncao();
        $where = $dao->getAdapter()->quoteInto("projeto_idProjeto = ?", $id);
        $dao->delete($where);
    }

}
