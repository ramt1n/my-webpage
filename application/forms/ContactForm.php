<?php

class Application_Form_ContactForm extends Zend_Form
{

    public function init()
    {
        $this->setAction('/mail/send')
             ->setMethod('post')
             ->setAttrib('id', 'contactForm');
        $this->clearDecorators();
        $decorators = array(
            array('ViewHelper'),
            array('Errors'),
            array('Label', array('requireSuffix' => ' *',
                                 'class' => 'leftalign')),
            array('HtmlTag', array('tag' => 'li'))
        );
        
        $this->addElement('text','from', array('label' => 'Od'));
        $username = $this->getElement('from')
                ->addValidator('alnum')
                ->addValidator('NotEmpty',true)
                ->addValidator('StringLength',true, array('min' => 3, 'max' => 20))
                ->setRequired(false)
                ->addFilter('StringTrim');
        $username->setDecorators($decorators);
        $username->getValidator('NotEmpty')->setMessages(array(
        Zend_Validate_NotEmpty::IS_EMPTY => "Nie podałeś swojego imienia."
        ));
        $username->getValidator('StringLength')->setMessages(array(
        Zend_Validate_StringLength::INVALID => 'Niepoprawny napis',
        Zend_Validate_StringLength::TOO_SHORT => 'Za krótki wpis',
        Zend_Validate_StringLength::TOO_LONG => "Imię za długie"
        ));
        
        $this->addElement('text','mailFrom', array('label' => 'E-mail Address'));
        $email = $this->getElement('mailFrom')
                ->addValidator('NotEmpty',true)
                ->addValidator('StringLength',true, array('min' => 4, 'max' => 60))
                ->setRequired(true)
                ->addValidator('EmailAddress')
                ->addFilter('StringTrim');
        $email->setDecorators($decorators);
        $email->getValidator('StringLength')->setMessages(array(
        Zend_Validate_StringLength::INVALID => 'Niepoprawny napis',
        Zend_Validate_StringLength::TOO_LONG => 'Za długi adres email',
        Zend_Validate_StringLength::TOO_SHORT => 'Niepoprawny adres email'
        ));
        $email->getValidator('NotEmpty')->setMessages(array(
        Zend_Validate_NotEmpty::IS_EMPTY => "To pole jest wymagane"
        ));
        $email->getValidator('EmailAddress')->setMessages(array(
        Zend_Validate_EmailAddress::INVALID => 'Niepoprawny adres email'
        ));
        
        $this->addElement('text','title', array('label' => 'Tytuł wiadomości'));
        $title = $this->getElement('title')
                ->addValidator('alnum')               
                ->setRequired(false)
                ->addFilter('StringTrim')
                ->addFilter('StripTags');
        $title->setDecorators($decorators);
        $this->addElement('textarea','message',array('label' => 'Treść'));
        $tresc = $this->getElement('message')
                ->addFilter('StringTrim')
                ->addFilter('HtmlEntities')
                ->setRequired(true)
                ->addValidator('NotEmpty',true);
        $tresc->setAttrib('cols', 40);
        $tresc->setDecorators($decorators);
        $tresc->getValidator('NotEmpty')->setMessages(array(
        Zend_Validate_NotEmpty::IS_EMPTY => "Brak treści wiadomości"
        ));
        $this->addElement('submit','Wyślij',array('label' => 'Wyślij wiadomość'));
    }


}

