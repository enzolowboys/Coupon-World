<?php

class UserController extends Zend_Controller_Action {
    protected $_logger;
    protected $_UserModel;
    protected $_authService;
    
   public function init()
    {
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
    
    public function logoutAction() {
        
        $this->_authService->clear();
        return $this->_helper->redirector('home','public');
    }
}