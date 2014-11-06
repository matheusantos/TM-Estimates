<?php

class Application_Model_DetalharFase extends Zend_Db_Table_Abstract {

    protected $_name = "fase";
    protected $_primary = "idFase";

    public function inserir(array $request) {
        $dados = array(
            'Descricao' => $request['Desc'],
            'Percentual' => $request['Percentual'],
            'datIniPrev' => $request['DatIniPre'],
            'datFinPrev' => $request['DatFinPre'],
            'datIniEfet' => $request['DatIniEfe'],
            'datFinEfet' => $request['DatFinEfe'],
            'Cliente_idCliente' => "1"
        );
        return $this->insert($dados);
    }

    public function _select($where = null, $order = null, $limit = null) {
        $select = $this->select()
                ->from($this)
                ->order($order)
                ->limit($limit);

        if (!is_null($where)) {
            $select->where($where);
        }
        return $this->fetchAll($select)->toArray();
    }

    public function find($id) {
        $arr = $this->find($id)->toArray();
        return $arr[0];
    }

    public function update(array $request) {
        $dados = array(
            'Descricao' => $request['Desc'],
            'Percentual' => $request['Percentual'],
            'datIniPrev' => $request['DatIniPre'],
            'datFinPrev' => $request['DatFinPre'],
            'datIniEfet' => $request['DatIniEfe'],
            'datFinEfet' => $request['DatFinEfe'],
        );
        $where = $this->getAdapter()->quoteInto("contato_id = ?", $request['contato_id']);
        $this->update($dados, $where);
    }

    public function delete($id) {
        $where = $this->getAdapter()->quoteInto("contato_id = ?", $id);
        $this->delete($where);
    }

}
