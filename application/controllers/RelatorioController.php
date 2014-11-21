<?php

class RelatorioController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
        $this->_helper->layout->setlayout("userlayout");
        $model1 = new Application_Model_Projeto();
        $dados1 = $model1->db_select();
        $this->view->assign("dados1", $dados1);
    }
    
    public function relatorioAction()
    {
        require_once('C:/xampp/htdocs/TM-Estimates/library/fpdf17/fpdf.php');
        // muito importante desabilitar a view de renderizar
        $this->_helper->viewRenderer->setNoRender();
        
        $model = new Application_Model_Projeto();
                
        $rows = $model->db_select();
        
        // instancia a classe FPDF
        $pdf = new FPDF('P','mm','A4');
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',12);
    
                    
        $pdf->Cell(36,10,'Projeto',0,0,'L');
        $pdf->Cell(36,10,'Est. de custo',0,0, 'L');
        $pdf->Cell(36,10,'Est. de Esforco',0,0,'L');
        $pdf->Cell(36,10,'Est. de Prazo',0,0,'L');
        $pdf->Cell(36,10,'Est. de Produtividade',0,0,'L');
        //$pdf->Cell(20,10,'Est. de Pontos de função',0,0,'L');
        
        // para colocar uma linha em branco
        $pdf->Cell(109,5,' ',0,0,'C');
        $pdf->Cell(40,5,' ',0,0,'C');
        $pdf->Cell(40,5,' ',0,1,'C');
         $pdf->Cell(109,5,' ',0,0,'C');
        $pdf->Cell(40,5,' ',0,0,'C');
        $pdf->Cell(40,5,' ',0,1,'C');
        
        $pdf->SetFont('Arial','',12);
        
        // percorre os dados 
        foreach ($rows as $dados)
        {
            $pdf->Cell(36,10,$dados['Titulo'],0,0,'L');
            //$pdf->Cell(60,10,$dados['nascimento'],0,0,'L');
            //$pdf->Cell(40,10,$dados['id_depto'],0,1,'C');            
        }
        
        //$pdf->Cell(0,10,'Page '.$pdf->PageNo().'/{nb}',0,0,'C');
        
        //gera o relatorio
        $pdf->Output();    
    }


}

