<?php

class Application_Model_DbTable_Cleinteequipe extends Zend_Db_Table_Abstract
{

    protected $_name = 'clienteEquipe';
    protected $_primary = array('Recursos_idRecursos','Projeto_idProjeto');


}

