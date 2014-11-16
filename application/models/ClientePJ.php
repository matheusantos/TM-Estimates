<?php
/*! Operações na tabela ClientePJ */
class Application_Model_ClientePJ extends Zend_Db_Table_Abstract {

    protected $_name = "clientepj";
    protected $_primary = "idCNPJ";

    public function inserir(array $request, $id) {
        //$data = date('Y-m-d H:i:s');
        
        $dados = array(
            'NomeFantasia' => $request['nomeFant'],
            'Telefone' => $request['tel'],
            'cliente_idCliente'=> $id,
            'CNPJ' => $request['cnpj']
        );
        return $this->insert($dados);
    }

     public function db_select($id){
      $db = Zend_Db_Table_Abstract::getDefaultAdapter();
      $select = $db->select()
      ->from('clientepf')
      ->where('cliente_idCliente='.$id);
      return $db->fetchAll($select);
      } 

}
