<?php

class Application_Model_DbTable_Equipe extends Zend_Db_Table_Abstract
{

    protected $_name = 'equipe';
    protected $_primary = array('Recursos_idRecursos','Projeto_idProjeto');


}

