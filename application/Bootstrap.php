<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    public function _initLanguages(){
        
        $languages = $this->getOption('languages');
        
        Zend_Registry::set('languages', $languages);
    }
    public function _initConfig(){
        $config = new Zend_Config_Ini(APPLICATION_PATH. '/configs/application.ini', APPLICATION_ENV);
        $registry = Zend_Registry::getInstance();
        $registry->set('config2', $config);
    }
    protected function _initAdresy(){
        
        $config = Zend_Registry::get('config2');
        $languages = array_keys($config->languages->toArray());
        
        $zl = new Zend_Locale();
        $lang = in_array($zl->getLanguage(), $languages)? $zl->getLanguage() : 'pl';
        
        $route = new Zend_Controller_Router_Route(
                ':lang/:controller/:action/*',
                array(
                    'controller' => 'index',
                    'action' => 'domowa',
                    'module' => 'default',
                    'lang'  => $lang
                      
                ));
        $router = $this->bootstrap('frontController')->getResource('frontController')->getRouter();
        $router->addRoute('default', $route);
        $front = $this->bootstrap('frontController')->getResource('frontController');
        $front->setRouter($router);
    }
    public function run() {
        $config = Zend_Registry::get('config2');
        $languages = array_keys($config->languages->toArray());        
        $zl = new Zend_Locale();
        
        $lang = in_array($zl->getLanguage(), $languages)? $zl->getLanguage() : 'pl';
        
        $route = new Zend_Controller_Router_Route(
                ':lang/:controller/:action/*',
                array(
                    'controller' => 'index',
                    'action' => 'domowa',
                    'module' => 'default',
                    'lang'  => $lang
                      
                ));
        
        $router = $this->bootstrap('frontController')->getResource('frontController')->getRouter();
        $router->addRoute('default', $route);
        $front = $this->bootstrap('frontController')->getResource('frontController');
        $front->setRouter($router);
        $config = Zend_Registry::get('config2');
        $rootDir = dirname(dirname(__FILE__));
        define('ROOT_DIR', $rootDir);        
        $frontController = Zend_Controller_Front::getInstance();
        $frontController->registerPlugin(new My_Application_Resource_LanguageSetup(APPLICATION_PATH.'/configs/translations',$config->languages->toArray()));
        
        parent::run();
       
    }

}

