<?php
/*! Operações na tabela DetalharFase */
class Application_Model_DetalharFase extends Zend_Db_Table_Abstract {

    protected $_name = "fase";
    protected $_primary = "idFase";

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
            'Descricao' => $request['Desc'],
            'Percentual' => $request['Percentual'],
            'datIniPrev' => $request['DatIniPre'],
            'datFinPrev' => $request['DatFinPre'],
            'datIniEfet' => $request['DatIniEfe'],
            'datFinEfet' => $request['DatFinEfe'],
        );
        $where = $this->getAdapter()->quoteInto("idFase = ?", $request['id']);
        $this->update($dados, $where);
    }

    public function db_delete($id) {
        $where = $this->getAdapter()->quoteInto("idFase = ?", $id);
        $this->delete($where);
    }

}
