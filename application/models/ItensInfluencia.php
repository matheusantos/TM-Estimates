<?php

/* ! Operações na tabela DetalharFase */

class Application_Model_ItensInfluencia extends Zend_Db_Table_Abstract {

    protected $_name = "itensinfluencia";
    protected $_primary = "idItensInfluencia";

    public function db_inserir(array $request, $id) {
        $dados = array(
            'ComunicacaoDados' => $request['comDados'],
            'ProcDistribuido' => $request['procDistr'],
            'Performace' => $request['perf'],
            'ConfAltaUtil' => $request['configUtil'],
            'FaixaTransacoes' => $request['faiTran'],
            'EntradaDadosOnLine' => $request['entDadOn'],
            'EficUserFinal' => $request['eficUserFin'],
            'AtualizacaoOnLine' => $request['attOn'],
            'ComplexidadeProc' => $request['comProc'],
            'Reutilizacao' => $request['reut'],
            'FacilidadeInstalacao' => $request['facInst'],
            'FacilidadeOperacao' => $request['facOp'],
            'MultiplasLocalidades' => $request['mulLoc'],
            'FacilidadeMudancas' => $request['facMud'],
            'projeto_idProjeto' => $id
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

    public function find($id) {
        $arr = $this->find($id)->toArray();
        return $arr[0];
    }

    public function db_update(array $request) {
        $dados = array(
            'ComunicacaoDados' => $request['comDados'],
            'ProcDistribuido' => $request['procDistr'],
            'Performace' => $request['perf'],
            'ConfAltaUtil' => $request['configUtil'],
            'FaixaTransacoes' => $request['faiTran'],
            'EntradaDadosOnLine' => $request['entDadOn'],
            'EficUserFinal' => $request['eficUserFin'],
            'AtualizacaoOnLine' => $request['attOn'],
            'ComplexidadeProc' => $request['comProc'],
            'Reutilizacao' => $request['reut'],
            'FacilidadeInstalacao' => $request['facInst'],
            'FacilidadeOperacao' => $request['facOp'],
            'MultiplasLocalidades' => $request['mulLoc'],
            'FacilidadeMudancas' => $request['facMud'],
            'projeto_idProjeto' => $id
        );
        $where = $this->getAdapter()->quoteInto("idItensInfluencia = ?", $request['id']);
        $this->update($dados, $where);
    }

    public function db_delete($id) {
        $where = $this->getAdapter()->quoteInto("idFase = ?", $id);
        $this->delete($where);
    }

}
