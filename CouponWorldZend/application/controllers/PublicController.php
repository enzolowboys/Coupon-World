<?php

class PublicController extends Zend_Controller_Action {
    
    protected $_logger;
    protected $topId;
    protected $_publicModel;
    
    public function init() {
        
        /*Abilito il layout*/
        $this->_helper->layout->setLayout('main');
        $this->_logger = Zend_Registry::get("log"); //file log
        /* istanzio il form */
        $this->_PublicModel = new Application_Model_Public(); //model
        $this->view->accediForm = $this->getAccediForm();
       
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
    
    private function getAccediForm()
	{
		$urlHelper = $this->_helper->getHelper('url');
		$this->_form = new Application_Form_Public_MyAccount_Accedi();
		$this->_form->setAction($urlHelper->url(array(
				'controller' => 'public',
				'action' => 'home'),
				'default'
				));
		return $this->_form;
	}
}

