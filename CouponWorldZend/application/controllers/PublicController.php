<?php

class PublicController extends Zend_Controller_Action {
    
    protected $_logger;
    
    public function init() {
        
        /*Abilito il layout*/
        $this->_helper->layout->setLayout('main');
        $this->_logger = Zend_Registry::get("log"); //file log

    }
    /*Override del metodo di IndexController*/
    public function indexAction() {
        
        /*Disabilito il layout perchè viene caricata la pagina di Benvenuto*/
        $this->_helper->layout->disableLayout();
        
    }
    /*Azione sulle categorie*/
    public function homeAction() {
        
        //log
        $this->_logger->info('Attivato ' . __METHOD__ . ' ');
    }
    
    /*Azione sulle offerte*/
    public function offerteAction() {
        
        //log
        $this->_logger->info('Attivato ' . __METHOD__ . ' ');
    }
    
    /*Azione sulle pagine statiche*/
    public function viewStaticAction() {
        
        //log
        $this->_logger->info('Attivato ' . __METHOD__ . ' ');
    }
}

