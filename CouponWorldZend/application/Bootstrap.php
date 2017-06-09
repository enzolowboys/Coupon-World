<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
        
     protected $_view;
     protected $_logger;
    

    protected function _initLogging()
    {
      
        $writer = new Zend_Log_Writer_Stream(APPLICATION_PATH.'/data/log/logFile.log');        
        $logger = new Zend_Log($writer);
        Zend_Registry::set("log", $logger);
        $this->_logger = $logger;
    	$this->_logger->info('Bootstrap ' . __METHOD__);
        
        
    }
     
    protected function _initRequest() {
	// Aggiunge un'istanza di Zend_Controller_Request_Http nel Front_Controller
	// che permette di utilizzare l'helper baseUrl() nel Bootstrap.php
	// Necessario solo se la Document-root di Apache non è la cartella public/
    
        $this->bootstrap('FrontController');
        $front = $this->getResource('FrontController');
        $request = new Zend_Controller_Request_Http();
        $front->setRequest($request);
    }
    
     protected function _initViewSettings()
    {
         /*Inizializzo la vista per impostare alcuni tag*/
        $this->bootstrap('view');
        $this->_view = $this->getResource('view');
        $this->_view->headMeta()->setCharset('UTF-8');
        $this->_view->headMeta()->appendHttpEquiv('Content-Language', 'it-IT');
	$this->_view->headLink()->appendStylesheet($this->_view->baseUrl('css/home.css'));
        
        $this->_view->headScript()->appendFile($this->_view->baseUrl().'/js/jquery.min.js');
        $this->_view->headScript()->appendFile($this->_view->baseUrl().'/js/functions.js');

        $this->_view->headScript()->appendFile($this->_view->baseUrl().'/js/jquery.js');


        
    }
    protected function _initDefaultModuleAutoloader()
    {
    	$loader = Zend_Loader_Autoloader::getInstance();
        $loader->registerNamespace('App_');
        $this->getResourceLoader()
             ->addResourceType('modelResource','models/resources','Resource');
  	}
        
       
    protected function _initFrontControllerPlugin() {
    	$front = Zend_Controller_Front::getInstance();
    	$front->registerPlugin(new App_Controller_Plugin_Acl());
    }
    
    
     
        



}

