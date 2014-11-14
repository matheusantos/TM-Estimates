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
    
    public function PontoFuncao($aliB, $aliM, $aliA, $aieB, $aieM, $aieA, $eeB, $eeM, $eeA,
            $seB, $seM, $seA, $ceB, $ceM, $ceA){
        
       $pf = ($aliB*7 + $aliM*10 + $aliA*15 + $aieB*5 + $aieM*7 + $aliA*10 + $eeB*3 + $eeM*4 + $eeA*6 +
               $seB*4 + $seM*5 + $seA*6);
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
