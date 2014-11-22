<?php

/* ! Operações na tabela Ambiente */

class Application_Model_FuncaoDados extends Zend_Db_Table_Abstract {

    protected $_name = "funcaodados";
    protected $_primary = "idFuncaoDados";

    public function inserir(array $request) {
        if ((($request['TipDados'] < 20) && ($request['TipRegis'] == 1)) || (($request['TipDados'] >= 20 || $request['TipDados'] <= 50) && ($request['TipRegis'] == 1)) || (($request['TipDados'] < 20) && ($request['TipRegis'] >= 2 || $request['TipRegis'] <= 5))) {
            $Complexidade = 1;
        } else if (($request['TipDados'] < 20 && $request['TipRegis'] > 5) || (($request['TipDados'] >= 20 || $request['TipDados'] <= 50) && ($request['TipRegis'] >= 2 && $request['TipRegis'] <= 5)) || (($request['TipDados'] > 50) && ($request['TipRegis'] == 1))) {
            $Complexidade = 2;
        } else if (((($request['TipDados'] > 50) && ($request['TipRegis'] >= 2) || ($request['TipRegis'] <= 5)) || (($request['TipDados'] > 50) && ($request['TipRegis'] > 5)) || (($request['TipDados'] >= 20) || ($request['TipDados'] <= 50) && ($request['TipRegis'] > 5)))) {
            $Complexidade = 3;
        } else {
            
        }
        if (($request['funcao'] == 'ALI' && $Complexidade == 1) || ($request['funcao'] == 'AIE' && $Complexidade = 2)) {
            $pfDados = 7;
        } else if (($request['funcao'] == 'ALI' && $Complexidade == 2) || ($request['funcao'] == 'AIE' && $Complexidade = 3)) {
            $pfDados = 10;
        } else if ($request['funcao'] == 'ALI' && $Complexidade == 3) {
            $pfDados = 15;
        } else if ($request['funcao'] == 'AIE' && $Complexidade == 1) {
            $pfDados = 5;
        }

        $dados = array(
            'Funcao' => $request['funcao'], 'Descricao' => $request['Descri'], 'qtdTiposRegistro' => $request['TipRegis'], 'qtdTiposDados' => $request['TipDados'], 'projeto_idProjeto' => $request['Projeto'], 'Complexidade' => $Complexidade, 'PF' => $pfDados,
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
        }
        return $this->fetchAll($select)->toArray();
    }

    public function pfTotal_select($id) {

        $dao = new Application_Model_DbTable_Funcaodados();

        $select = $dao->select()
                ->from($dao, new Zend_Db_Expr('SUM(PF)'))
                ->where('projeto_idProjeto' . '= ?', $id);

        return $dao->fetchAll($select)->toArray();
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
