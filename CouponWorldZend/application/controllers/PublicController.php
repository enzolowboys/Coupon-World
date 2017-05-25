<?php

class PublicController extends Zend_Controller_Action {
    
    protected $_logger;
    protected $topId;
    protected $_publicModel;
    
    public function init() {
        
        /*Abilito il layout*/
        $this->_helper->layout->setLayout('main');
        $this->_logger = Zend_Registry::get("log"); //file log
        /* istanzio in model*/
        $this->_PublicModel = new Application_Model_Public(); //model
       
    }
    
    /*Override del metodo di IndexController*/
    public function indexAction() {
        
        /*Disabilito il layout perchè viene caricata la pagina di Benvenuto*/
        $this->_helper->layout->disableLayout();
        
    }
    
    /*Azione per attivare la homepage*/
    public function homeAction() {
        
      
        //log
        $this->_logger->info('Attivato ' . __METHOD__ . ' ');
       $cat=$this->_PublicModel->getpromozioneByid();
       $this->view->assign(array('offerta'=>$cat)
        );
        
    }
    
   public function categorieAction () {
       
       //log
        $this->_logger->info('Attivato ' . __METHOD__ . ' ');
        $catId = $this->_getParam('catId', null);
        $this->view->assign(array(
            'categoria' => $catId)
        );
        
        
   }
   
    /*Azione sulle offerte*/
    public function offerteAction() {
        
        //log
        $this->_logger->info('Attivato ' . __METHOD__ . ' ');
    }
    
    /*Azione sulle pagine statiche*/
    public function viewstaticAction() {
        
        //log
        $this->_logger->info('Attivato ' . __METHOD__ . ' ');
        
        $page = $this->_getParam('staticPage');
        $this->render($page);
    }
}

