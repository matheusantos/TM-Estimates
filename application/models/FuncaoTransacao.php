<?php
/*! Operações na tabela Ambiente */
class Application_Model_FuncaoTransacao extends Zend_Db_Table_Abstract {

    protected $_name = "funcaotransacao";
    protected $_primary = "idFuncaoTransacao";
    
    public function inserir(array $request) {           
        if($request['funcao'] == 'EE'){
            if(($request['TipDados']<5 && $request['ArqRef']<=2) || (($request['TipDados']>=5 && $request['TipDados']<=15) &&($request['ArqRef']<2))){ $Complexidade = 1; $pfTrans = 3;}
            else if (($request['ArqRef'] > 2 && $request['TipDados'] < 5) || ($request['ArqRef'] == 2 && ($request['TipDados'] >= 5 && $request['TipDados'] <= 15)) || ($request['TipDados'] > 15 && $request['ArqRef'] < 2)){$Complexidade = 2; $pfTrans = 4;
            } else if(($request['TipDados']>= 2 && $request['ArqRef']>15) || (($request['TipDados']>=5 && $request['TipDados']<=15) && $request['ArqRef']>2)) {$Complexidade=3; $pfTrans = 6;}
        } else if($request['funcao'] == 'SE'){
            if(($request['ArqRef']<=3 && $request['TipDados']<6 )||(($request['ArqRef']<2)&&($request['TipDados']>=6 && $request['TipDados']<=19))){$Complexidade = 1; $pfTrans =4;}
            else if(($request['TipDados']<6 && $request['ArqRef']>3)||(($request['ArqRef']>=2 && $request['ArqRef']<=3)&&($request['TipDados']>=6 && $request['TipDados']<=19)) || ($request['TipDados']>19 && $request['ArqRef']>3)){$Complexidade = 2; $pfTrans = 5;}
            else if(($request['TipDados']>19 && $request['ArqRef']>=2)|| (($request['TipDados']>=6 && $request['TipDados']<=19)&& ($request['ArqRef']>3)  )){ $Complexidade = 3; $pfTrans = 7;}
        } else if($request['funcao'] == 'CE'){
            if(($request['ArqRef']<=3 && $request['TipDados']<6 )||(($request['ArqRef']<2)&&($request['TipDados']>=6 && $request['TipDados']<=19))){$Complexidade = 1; $pfTrans =3;}
            else if(($request['TipDados']<6 && $request['ArqRef']>3)||(($request['ArqRef']>=2 && $request['ArqRef']<=3)&&($request['TipDados']>=6 && $request['TipDados']=19)) || ($request['TipDados']>19 && $request['ArqRef']>3)){$Complexidade = 2; $pfTrans = 4;}
            else if(($request['TipDados']>19 && $request['ArqRef']>=2)|| (($request['TipDados']>=6 && $request['TipDados']<=19)&& ($request['ArqRef']>3)  )){ $Complexidade = 3; $pfTrans = 6;}
        }
        $request['TipDados'] = array(
            'Funcao' => $request['funcao'], 'Descricao' => $request['Descri'],
            'qtdArquivoRef' => $request['ArqRef'],'qtdTipoDados' => $request['TipDados'],
            'projeto_idProjeto' => $request['Projeto'],'Complexidade' => $Complexidade, 'PF' => $pfTrans,
        );
        return $this->insert($request['TipDados']);
    }

    public function pfTotal_select($id) {
        $dao = new Application_Model_FuncaoTransacao();
        $select = $dao->select()
                         ->from($this, new Zend_Db_Expr('SUM(PF)'))
                         ->where('projeto_idProjeto'.'= ?',$id);
        
        return $dao->fetchAll($select)->toArray();
    }
    
    public function db_select($where = null, $valor = null, $order = null, $limit = null) {
        $select = $this->select()
                        ->from($this)
                        ->order($order)
                        ->limit($limit);
		
        if (!is_null($where)) {
            $select->where($where.'= ?', $valor);
            //$select->where($where.'='. $valor);
        }
        return $this->fetchAll($select)->toArray();
    }

    public function find($id) {
        $arr = $this->find($id)->toArray();
        return $arr[0];
    }

    public function db_update(array $request) {
        $dados = array(
            'Funcao' => $request['funcao'],
            'Descricao' => $request['Descri'],
            'qtdArquivoRef' => $request['ArqRef'],
            'qtdTipoDados' => $request['TipDados'],
            //'Complexidade' => $Complexidade,
            //'PF' => $pfDados,
        );
        $where = $this->getAdapter()->quoteInto("idFuncaoTransacao = ?", $request['id']);
        $this->update($dados, $where);
    }

    public function db_delete($id) {
        $where = $this->getAdapter()->quoteInto("idFuncaoTransacao = ?", $id);
        $this->delete($where);
    }

}
