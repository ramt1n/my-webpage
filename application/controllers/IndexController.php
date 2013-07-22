<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function domowaAction()
    {
       
    }

    public function kontaktAction()
    {
        $this->view->form = new Application_Form_ContactForm(); 
    }

    public function galeriaAction()
    {
        // action body
    }

    public function ofirmieAction()
    {
        // action body
    }


}









