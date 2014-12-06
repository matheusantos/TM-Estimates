<?php

/* ! Operações com a tabela Equipe */

class Application_Model_Equipe {

    public function db_insert(array $request) {
        $dao = new Application_Model_DbTable_Equipe();
        $dados = array(
            'Projeto_idProjeto' => $request['Projeto'],
            'Recursos_idRecursos' => $request['Recurso'],
            'QtRecursos' => $request['QtdRec'],
        );
        return $dao->insert($dados);
    }

    public function db_select($where = null, $valor = null, $order = null, $limit = null) {
        $dao = new Application_Model_DbTable_Equipe();
        $select = $dao->select()
                ->from($dao)
                ->order($order)
                ->limit($limit);

        if (!is_null($where)) {
            $select->where($where . '= ?', $valor);
            //$select->where($where.'='. $valor);
        }
        return $dao->fetchAll($select)->toArray();
    }

    public function db_update(array $request) {
        $dao = new Application_Model_DbTable_Equipe();
        $dados = array(
            'QtRecursos' => $request['QtdRec'],
        );
        $where = $dao->getAdapter()->quoteInto('Recursos_idRecursos = ?', $request['id']);
        $dao->update($dados, $where);
    }

    public function db_delete($id) {
        $dao = new Application_Model_DbTable_Equipe();
        $where = $dao->getAdapter()->quoteInto("Recursos_idRecursos = ?", $id);
        $dao->delete($where);
    }

}
