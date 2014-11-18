<?php
/*! Operações na tabela Ambiente */
class Application_Model_Calculos extends Zend_Db_Table_Abstract {
    
    public function produtividade($n1, $n2, $n3, $n4, $n5 ) {
        
        $produtividade = $n1+($n2*2)+($n3*3)+($n4*4)+($n5*5);
    }
    
    public function esforco($pf, $prod) {
        
        $esforco = $pf/$prod;
    }
    
    public function prazo($esforco, $n) {
        
        $prazo = $esforco*3/($n*5);
        
    }
    
    public function custo($n1, $n2, $n3, $n4, $n5, $qh1, $qh2, $qh3,
            $qh4, $qh5, $vh1, $vh2, $vh3, $vh4, $vh5, $custEx) {
        $custo = (($qh1*$vh1*$n1*8)+($qh2*$vh2*$n2*8)+($qh3*$vh3*$n3*8)+
                ($qh4*$vh4*$n4*8)+($qh5*$vh5*$n5*8));
    }
    
    public function FuncDados($where = null, $descricao = null, $order = null, $limit = null){
        $Complexidade;  //Variável para verificar a complexidade de ALI E AIE
        $pfDados;       //Variável para receber os pontos de função dos Dados
        
        $TipoDados = $this->select()
                ->from('funcaodados', array('qtdTiposDados'))
                ->where('Descricao =', $descricao);
        
        $TiposRegistro = $this->select()
                ->from('funcaodados', array('qtdTiposRegistro'))
                ->where('Descricao =', $descricao);
        
        $Funcao = $this->select()
                ->from('funcaodados', array('Funcao'))
                ->where('Descricao =', $where);
        
        //Verificando a complexidade da Função de Dados
        if((($TipoDados < 20)&&($TiposRegistro==1)) || 
                (($TipoDados>=20 || $TipoDados<=50) &&($TiposRegistro==1)) ||
                (($TipoDados < 20) && ($TiposRegistro>=2 || $TiposRegistro<=5))){
            $Complexidade = 1;
        }
        else if(($TipoDados<20 && $TiposRegistro>5)
                || (($TipoDados>=20 || $TipoDados<=50) &&($TiposRegistro>=2 || $TiposRegistro<=5))
                || (($TipoDados>50)&&($TiposRegistro==1))){
            $Complexidade = 2;
        }
        else if((($TipoDados>50)&&($TiposRegistro>=2 || $TiposRegistro<=5))||
                (($TipoDados>50) &&($TiposRegistro>5))||
                (($TipoDados>=20 || $TipoDados<=50)&&($TiposRegistro>5))){
            $Complexidade = 3;
        }
        
        if(($Funcao == 'ALI' && $Complexidade = 1) || ($Funcao == 'AIE' && $Complexidade = 2)){
            
            $pfDados = 7;
        }
        else if(($Funcao == 'ALI' && $Complexidade = 2) || ($Funcao == 'AIE' && $Complexidade= 3)){
            $pfDados = 10;
        }
        else if($Funcao == 'ALI' && $Complexidade = 3){
            $pfDados = 15;
        }
        else if ($Funcao == 'AIE' && $Complexidade = 1) {
            $pfDados = 5;
        }
        
        
    }
    
    public function fatorReajuste($comDad, $proDis, $perf, $confAltUti, $taxTrans, $entDados, $efiUsuFin,
            $atuali, $compProc, $reuti, $faciInst, $faciOper, $multLoca, $faciMudan) {
        $ajuste = ($comDad + $proDis + $perf + $confAltUti + $taxTrans + $entDados + $efiUsuFin +
            $atuali + $compProc + $reuti + $faciInst + $faciOper + $multLoca + $faciMudan);
        $ajuste = ($ajuste * 0.01) + 0.65;
    }
    
    public function pfReajustada($pf, $fatorDesajus) {
        
        $fatorAjus = $fatorDesajus * $pf;
    }

}
