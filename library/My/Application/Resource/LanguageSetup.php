<?php

class My_Application_Resource_LanguageSetup extends Zend_Controller_Plugin_Abstract{
    
    protected $_languages;
    protected $_directory;
    
    public function __construct($directory, $language) {
        
        $this->_directory = $directory;
        $this->_languages = $language;
        
    }
    
    public function dispatchLoopStartup(Zend_Controller_Request_Abstract $request) {
        
        $lang = $this->getRequest()->getParam('lang');
        Zend_Registry::set('lang',$lang);
        $lang = Zend_Registry::get('lang');
        if(!in_array($lang, array_keys($this->_languages))){
            
            $lang = 'pl';
            
        }
        
        
        $localeString = $this->_languages[$lang];
        
        $locale = new Zend_Locale($localeString);
        
        $file = $this->_directory .'/'. $localeString . '.php';
        $uhm =  file_get_contents($file);
        if(file_exists($file)){
            $translationStrings = include $file;
             
            
        }else{
            
            $translationStrings = include $this->_directory . '/pl_PL.php'; 
        }
        
        
        
        
        if(empty($translationStrings)){
            throw new Exception ('Brakuje $translationStrings w pliku językowym');
        }
        $translate = new Zend_Translate('array',$translationStrings, $localeString);
        
        Zend_Registry::set('lang', $lang);
        Zend_Registry::set('localeString', $localeString);
        Zend_Registry::set('locale', $locale);
        Zend_Registry::set('Zend_Translate', $translate);
        var_dump(Zend_Registry::get('lang'));
    }
}
?>
