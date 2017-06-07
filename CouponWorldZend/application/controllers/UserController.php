<?php

class UserController extends Zend_Controller_Action {
    protected $_logger;
    protected $_UserModel;
    protected $_authService;
    
   public function init()
    {
        $this->_logger = Zend_Registry::get("log"); //file log
        $this->_helper->layout->setLayout('layoutstatic');
        $this->_authService = new Application_Service_Auth();
        
        $this->_UserModel = new Application_Model_User(); //model
        
        /* azioni sulle form di inserimento */
        
        //Creo l'oggetto Auth
        $this->_authService = new Application_Service_Auth();
    }

    public function indexAction()
    {
        
       
    }
    
    public function stampaoffertaAction(){
      /*Disabilito il layout perchè viene caricata la pagina di Benvenuto*/
      $this->_helper->layout->disableLayout();
    
      $this->_logger->info('Attivato ' . __METHOD__ . ' ');
        
        $param= $this->_getParam('offertaid');
        
         $this->_logger->info($param);
        
         $stampafferta = $this->_UserModel->getPromozioneById($param);
         $this->_logger->debug(print_r($stampafferta, true));
         $this->view->assign(array('stampaofferta'=>$stampafferta));
         

    }
    
    public function logoutAction() {
        
        $this->_authService->clear();
        return $this->_helper->redirector('home','public');
    }
}