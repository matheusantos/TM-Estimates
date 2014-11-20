<?php

/* ! Operações na tabela Recursos */

class Application_Model_Recursos extends Zend_Db_Table_Abstract {

    protected $_name = "recursos";
    protected $_primary = "idRecursos";

    public function db_inserir(array $request, $id) {
        $dados = array(
            'Descricao' => $request['descricao'],
            'Carga_horaria' => $request['carga_horaria'],
            'Custo' => $request['custo1'],
            'Nivel' => $request['nivel'],
            'projeto_idProjeto' => $request['Projeto']
        );
        return $this->insert($dados);
    }

    public function n_select($nivel, $id) {

        $select = $this->select()
        ->from($this)
        ->where('Nivel' . '= ?', $nivel)
        ->where('projeto_idProjeto' . '= ?', $id);

        return $this->fetchAll($select)->toArray();
    }

    public function db_update(array $request) {

        $dados = array(
            'Descricao' => $request['descricao'],
            'Carga_horaria' => $request['carga_horaria'],
            'Custo' => $request['custo'],
            'Nivel' => $request['nivel'],
        );

        $where = $this->getAdapter()->quoteInto('idRecursos = ?', $request['id']);

        $this->update($dados, $where);
    }

    public function db_delete($id) {
        $where = $this->getAdapter()->quoteInto("idRecursos = ?", $id);
        $this->delete($where);
    }

}
