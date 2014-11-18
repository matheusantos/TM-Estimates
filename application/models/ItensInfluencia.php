<?php

/* ! Operações na tabela DetalharFase */

class Application_Model_ItensInfluencia extends Zend_Db_Table_Abstract {

    protected $_name = "itensinfluencia";
    protected $_primary = "idItensInfluencia";

    public function db_inserir(array $request, $id) {
        $cgs=$request['comDados'] + $request['procDistr'] + $request['perf'] + $request['configUtil'] + 
        $request['faiTran'] + $request['entDadOn'] + $request['eficUserFin'] + $request['attOn']
        + $request['comProc'] + $request['reut'] + $request['facInst'] + $request['facOp'] 
        + $request['mulLoc'] + $request['facMud'];
        $fatorAjuste = ($cgs *0.01)+0.65;
        $dados = array(
            'ComunicaoDados' => $request['comDados'], 'ProcDistribuido' => $request['procDistr'],
            'Performace' => $request['perf'], 'ConfAltaUtil' => $request['configUtil'],
            'FaixaTransacoes' => $request['faiTran'],'EntradaDadosOnLine' => $request['entDadOn'],
            'EficUserFinal' => $request['eficUserFin'],'AtualizacaoOnLine' => $request['attOn'],
            'ComplexidadeProc' => $request['comProc'], 'Reutilizacao' => $request['reut'],
            'FacilidadeInstalacao' => $request['facInst'],'FacilidadeOperacao' => $request['facOp'],
            'MultiplasLocalidades' => $request['mulLoc'],'FacilidadeMudancas' => $request['facMud'],
            'projeto_idProjeto' => $id, 'FatorAjuste' => $fatorAjuste
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
            'ComunicaoDados' => $request['comDados'],
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
            'FacilidadeMudancas' => $request['facMud']
        );
        $where = $this->getAdapter()->quoteInto("projeto_idProjeto = ?", $request['id']);
        $this->update($dados, $where);
    }

    public function db_delete($id) {
        $where = $this->getAdapter()->quoteInto("idItensInfluencia = ?", $id);
        $this->delete($where);
    }

}
