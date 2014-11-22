<?php

class RelatorioController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
         $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            $identity = $auth->getIdentity();
            $this->usuario = get_object_vars($identity);
        }
        $this->_helper->layout->setlayout("userlayout");
        $this->view->assign("email", $this->usuario['Email']);
    }

    public function indexAction() {
        // action body
        $this->_helper->layout->setlayout("userlayout");
        $model1 = new Application_Model_Projeto();
        $dados1 = $model1->db_select();
        $this->view->assign("dados1", $dados1);
    }

    public function relatorioAction() {
        require_once('C:/xampp/htdocs/TM-Estimates/library/fpdf/fpdf.php');
        // muito importante desabilitar a view de renderizar
        $this->_helper->viewRenderer->setNoRender();

        $model = new Application_Model_ViewRelatorio();

        $rows = $model->db_select();

        // instancia a classe FPDF
        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->AddPage();


        // percorre os dados 
        foreach ($rows as $dados) {
            $pdf->SetFont('Arial', 'B', 26);
            $pdf->Cell(190, 20, $dados['Titulo'], 0, 0, 'C');
            $pdf->Cell(109, 5, ' ', 0, 0, 'C');
            $pdf->Cell(40, 5, ' ', 0, 0, 'C');
            $pdf->Cell(40, 5, ' ', 0, 1, 'C');
            $pdf->Cell(109, 5, ' ', 0, 0, 'C');
            $pdf->Cell(40, 5, ' ', 0, 0, 'C');
            $pdf->Cell(40, 5, ' ', 0, 1, 'C');
            $pdf->Cell(190, 20, 'Relatório de estimativas', 0, 0, 'C');
            $pdf->Cell(109, 5, ' ', 0, 0, 'C');
            $pdf->Cell(40, 5, ' ', 0, 0, 'C');
            $pdf->Cell(40, 5, ' ', 0, 1, 'C');
            $pdf->Cell(109, 5, ' ', 0, 0, 'C');
            $pdf->Cell(40, 5, ' ', 0, 0, 'C');
            $pdf->Cell(40, 5, ' ', 0, 1, 'C');
            $pdf->Cell(109, 5, ' ', 0, 0, 'C');
            $pdf->Cell(40, 5, ' ', 0, 0, 'C');
            $pdf->Cell(40, 5, ' ', 0, 1, 'C');
            $pdf->Cell(109, 5, ' ', 0, 0, 'C');
            $pdf->Cell(40, 5, ' ', 0, 0, 'C');
            $pdf->Cell(40, 5, ' ', 0, 1, 'C');

            $pdf->SetFont('Arial', 'B', 12);

            $pdf->Cell(36, 10, 'Projeto', 0, 0, 'L');
            $pdf->Cell(36, 10, 'Est. de custo', 0, 0, 'L');
            $pdf->Cell(36, 10, 'Est. de Esforço', 0, 0, 'L');
            $pdf->Cell(36, 10, 'Est. de Prazo', 0, 0, 'L');
            $pdf->Cell(36, 10, 'Est. de Produtividade', 0, 0, 'L');
            //$pdf->Cell(20,10,'Est. de Pontos de função',0,0,'L');
            // para colocar uma linha em branco
            $pdf->Cell(109, 5, ' ', 0, 0, 'C');
            $pdf->Cell(40, 5, ' ', 0, 0, 'C');
            $pdf->Cell(40, 5, ' ', 0, 1, 'C');
            $pdf->Cell(109, 5, ' ', 0, 0, 'C');
            $pdf->Cell(40, 5, ' ', 0, 0, 'C');
            $pdf->Cell(40, 5, ' ', 0, 1, 'C');

            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(36, 10, $dados['Titulo'], 0, 0, 'L');
            $pdf->Cell(36, 10, $dados['Custo'], 0, 0, 'L');
            $pdf->Cell(36, 10, $dados['Prazo'], 0, 0, 'L');
            $pdf->Cell(36, 10, $dados['Esforco'], 0, 0, 'L');
            $pdf->Cell(36, 10, $dados['Produtividade'], 0, 0, 'L');

            $pdf->Cell(109, 5, ' ', 0, 0, 'C');
            $pdf->Cell(40, 5, ' ', 0, 0, 'C');
            $pdf->Cell(40, 5, ' ', 0, 1, 'C');
            $pdf->Cell(109, 5, ' ', 0, 0, 'C');
            $pdf->Cell(40, 5, ' ', 0, 0, 'C');
            $pdf->Cell(40, 5, ' ', 0, 1, 'C');
            $pdf->Cell(109, 5, ' ', 0, 0, 'C');
            $pdf->Cell(40, 5, ' ', 0, 0, 'C');
            $pdf->Cell(40, 5, ' ', 0, 1, 'C');
            $pdf->Cell(109, 5, ' ', 0, 0, 'C');
            $pdf->Cell(40, 5, ' ', 0, 0, 'C');
            $pdf->Cell(40, 5, ' ', 0, 1, 'C');
        }

        //$pdf->Cell(0,10,'Page '.$pdf->PageNo().'/{nb}',0,0,'C');
        //gera o relatorio
        $pdf->Output('relatorio.pdf', 'I');
    }

}
