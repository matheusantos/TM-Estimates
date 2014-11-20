<?php

/* ! Operações na tabela Cliente */

class Application_Model_Cliente {

    public function inserir(array $request) {
        $dao = new Application_Model_DbTable_Cliente();
        $dados = array(
            'Email' => $request['email'],
            'Senha' => md5($request['ConfSenha']),
            'EXCLUIDO' => FALSE,
            'Cep' => $request['cep'],
            'Logradouro' => $request['rua'],
            'Bairro' => $request['bairro'],
            'Numero' => $request['numero'],
            'Complemento' => $request['complemento'],
            'Cidade' => $request['cidade'],
            'UF' => $request['estado'],
        );
        return $dao->insert($dados);
    }

    public function db_select($where = null, $valor = null, $order = null, $limit = null) {
        $dao = new Application_Model_DbTable_Cliente();
        $select = $dao->select()
                ->from($dao)
                ->order($order)
                ->limit($limit);

        if (!is_null($where)) {
            $select->where($where . '= ?', $valor);
        }
        return $dao->fetchAll($select)->toArray();
    }

    public function db_update_senha($id, $senha_md5) {
        $dao = new Application_Model_DbTable_Cliente();
        $dados = array(
            'Senha' => $senha_md5
        );
        $where = $dao->getAdapter()->quoteInto("idCliente = ?", $id);
        $dao->update($dados, $where);
    }
    
    public function db_delete($id) {
        $dao = new Application_Model_DbTable_Cliente();
        $where = $dao->getAdapter()->quoteInto("idCliente = ?", $id);
        $dao->delete($where);
    }
    
    public function db_update(array $request) {
        $dao = new Application_Model_DbTable_Cliente();
        $dados = array(
            'EXCLUIDO' => FALSE,
            'Cep' => $request['cep'],
            'Logradouro' => $request['rua'],
            'Bairro' => $request['bairro'],
            'Numero' => $request['numero'],
            'Complemento' => $request['complemento'],
            'Cidade' => $request['cidade'],
            'UF' => $request['estado'],
        );
        $where = $dao->getAdapter()->quoteInto("idCliente = ?", $request['id']);
        $dao->update($dados, $where);
    }

}
