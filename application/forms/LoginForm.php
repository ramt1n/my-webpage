<?php

class Application_Form_LoginForm extends Zend_Form
{

    public function init()
    {
       $this->setMethod('post')
               ->setAction('/auth/index')
               ->setAttrib('class', 'login');
       
       $this->clearDecorators();
       $decorators = array(
               array('ViewHelper'),
               array('Errors'),
               array('Label', array(
                   'requiredSuffix' => ' *',
                   'class' => 'leftalign')),
               
               array('HtmlTag', array('tag' => 'p')));
       
       $this->addElement('text', 'username', array('label' => 'Username'));
       $username = $this->getElement('username')
                    ->addFilter('StringTrim')
                    ->addFilter('StripTags')
                    ->setRequired(true)
                    ->addValidator('NotEmpty')
                    ->addValidator('EmailAddress');
       
       $username->setAttrib('id', 'login');
       
              
       $username->getValidator('EmailAddress')->setMessages(array(
       Zend_Validate_EmailAddress::INVALID => 'Niepoprawny adres email'
               ));
       $username->getValidator('NotEmpty')->setMessages(array(
       Zend_Validate_NotEmpty::IS_EMPTY => 'To pole jest wymagane' 
       ));
       $username->setDecorators($decorators);
       $this->addElement('password','password', array('label' => 'Hasło', 'id' => 'login'));
       $password = $this->getElement('password')
               ->addFilter('StringTrim')
                    ->addFilter('StripTags')
                    ->setRequired(true)
                    ->addValidator('StringLength',true, array('min' => 6, 'max' => 20))
                    ->addValidator('NotEmpty');
       
       
       $password->getValidator('NotEmpty')->setMessages(array(
       Zend_Validate_NotEmpty::IS_EMPTY => 'To pole jest wymagane'
       ));
       $password->getValidator('StringLength')->setMessages(array(
       Zend_Validate_StringLength::TOO_SHORT => 'Za krórkie hasło',
       Zend_Validate_StringLength::TOO_LONG => 'Hasło za długie'
       ));
       $password->setDecorators($decorators);
       $this->addElement('button','Zaloguj');
       $przycisk = $this->getElement('Zaloguj')->setAttrib('class', 'login-button')
               ->setAttrib('type', 'submit')
               ->setDecorators(array(
               array('ViewHelper'),
               array('Errors'),              
               array('HtmlTag', array('tag' => 'p', 'class' => 'login-submit'))));
               
        $this->setDecorators(array(
            'FormElements',
            'Form'
           ));
    
    }


}

