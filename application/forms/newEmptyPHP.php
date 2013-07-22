<?php

<?php

class Application_Form_LoginForm extends Zend_Form
{

    public function init()
    {
       $this->setMethod('post')
               ->setAction('authorize')
               ->setAttrib('class', 'login');
               
       
       $this->clearDecorators();
       $decorators = array(
               array('ViewHelper'),
               array('Errors'),
               array('Label', array(
                   'requiredSuffix' => ' *',
                   'class' => 'leftalign')),
               
               array('HtmlTag', array('tag' => 'p')),);
       
       $this->addElement('text', 'username', array('label' => 'Username'));
       $username = $this->getElement('username')
                    ->addFilter('StringTrim')
                    ->addFilter('StripTags')
                    ->setRequired(true)
                    ->addValidator('NotEmpty')
                    ->addValidator('EmailAddress');
       
       $username->setAttrib('id', 'login');
       $username->setDecorators($decorators);
              
       $username->getValidator('EmailAddress')->setMessages(array(
       Zend_Validate_EmailAddress::INVALID => 'Niepoprawny adres email'
               ));
       $username->getValidator('NotEmpty')->setMessages(array(
       Zend_Validate_NotEmpty::IS_EMPTY => 'To pole jest wymagane' 
       ));
       
       $this->addElement('password','password', array('label' => 'Hasło', 'id' => 'login'));
       $password = $this->getElement('password')
               ->addFilter('StringTrim')
                    ->addFilter('StripTags')
                    ->setRequired(true)
                    ->addValidator('StringLength',true, array('min' => 6, 'max' => 20))
                    ->addValidator('NotEmpty');
       
       $password->setDecorators($decorators);
       $password->getValidator('NotEmpty')->setMessages(array(
       Zend_Validate_NotEmpty::IS_EMPTY => 'To pole jest wymagane'
       ));
       $password->getValidator('StringLength')->setMessages(array(
       Zend_Validate_StringLength::TOO_SHORT => 'Za krórkie hasło',
       Zend_Validate_StringLength::TOO_LONG => 'Hasło za długie'
       ));
       
       $this->addElement('button','Zaloguj', array('class' => 'login-button'));
       $przycisk = $this->getElement('Zaloguj')->setAttrib('type', 'submit')
            ->setDecorator('HtmlTag', array('tag' => 'p', 'class' => 'login_submit'));
       
       $this->setDecorators(array(
           'FormElements',
           'Form', array('class' => 'login')
       ));
    }


}


?>
