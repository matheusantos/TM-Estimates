<?php
/*! Operações na tabela Cliente */
class Application_Model_Cliente extends Zend_Db_Table_Abstract {

    protected $_name = "cliente";
    protected $_primary = "idCliente";

    public function inserir(array $request) {
        $dados = array(
            'Email' => $request['email'],
            'Senha' => md5($request['ConfSenha']),
            'EXCLUIDO' => FALSE,
            'Cep' => $request['cep'],
            'Logradouro' => $request['rua'],
            'Bairro' => $request['bairro'],
            'Numero' => $request['numero'],
            'Complemento' => NULL,
            'Cidade' => $request['cidade'],
            'UF' => $request['estado'],
        );
        return $this->insert($dados);
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

}
