<?php

class IndexController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */

        //if (!Zend_Auth::getInstance()->hasIdentity()) {
        //    $this->_redirect('login');
        //}
    }

    public function indexAction() {
        // action body
        //$this->_helper->layout->setlayout("userlayout");
    }

}
