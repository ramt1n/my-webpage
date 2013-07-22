<?php

class AuthController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {   
        $layout = $this->_helper->layout();
        $layout->setLayout('layout2');
        $this->view->form = new Application_Form_LoginForm;
    }


}

