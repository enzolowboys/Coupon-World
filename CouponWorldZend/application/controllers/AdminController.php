<?php

class AdminController extends Zend_Controller_Action {
    
    protected $_logger;
    protected $_AdminModel;
    protected $_authService;
    protected $formInserimentoNuovaAzienda;
    protected $formInserimentoTipologia;
    
   public function init()
    {
        $this->_logger = Zend_Registry::get("log"); //file log
        $this->_helper->layout->setLayout('layoutstatic');
        
        $this->_AdminModel = new Application_Model_Admin(); //model
        
        $this->view->nuovaaziendaForm = $this->getInserisciAziendaForm();
        $this->view->nuovatipologiaForm = $this->getInserisciTipologiaForm();
        //Creo l'oggetto Auth
        $this->_authService = new Application_Service_Auth();
    }

    public function indexAction()
    {
        
       
    }
    
    /* Pagina per l'inserimento dell'azienda */
    public function nuovaaziendaAction(){
        
    }
    
     /* Pagina per l'inserimento della tipologia */
    public function nuovatipologiaAction(){
        
    }
    
    //funzione per la registrazione
    public function inserimentoaziendaAction(){
        
        $this->_logger->info('Attivato ' . __METHOD__ . ' ');
       
     
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('home');
        }
        $formInserimentoNuovaAzienda =  new Application_Form_Admin_NuovaAzienda_InserimentoNuovaAzienda();
        
        if (!$formInserimentoNuovaAzienda->isValid($_POST)){
            
            $formInserimentoNuovaAzienda->setDescription('ATTENZIONE! dati inseriti non validi!');
            $this->_logger->info('Attivato If della form registrazione');
            $formInserimentoNuovaAzienda->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            $this->_logger->debug(print_r($formInserimentoNuovaAzienda->getErrors(), true));
            return $this->render('nuovaazienda');
            
        
        }
        $values = $formInserimentoNuovaAzienda->getValues();
        $this->_AdminModel->insertAzienda($values);
        $this->_helper->redirector('index');
    }
    
    //funzione per la registrazione
    public function inserimentotipologiaAction(){
        $this->_logger->info('Attivato ' . __METHOD__ . ' ');
       
     
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('home');
        }
        $formInserimentoNuovaAzienda =  new Application_Form_Admin_NuovaAzienda_InserimentoNuovaAzienda();
        
        if (!$formInserimentoNuovaAzienda->isValid($_POST)){
            
            $formInserimentoNuovaAzienda->setDescription('ATTENZIONE! dati inseriti non validi!');
            $this->_logger->info('Attivato If della form registrazione');
            $formInserimentoNuovaAzienda->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            $this->_logger->debug(print_r($formInserimentoNuovaAzienda->getErrors(), true));
            return $this->render('nuovaazienda');
            
        
        }
        $values = $formInserimentoNuovaAzienda->getValues();
        $this->_AdminModel->insertAzienda($values);
        $this->_helper->redirector('index');
    }
    
    /*Metrodo che ritorna la form*/
    private function getInserisciAziendaForm() {
	$urlHelper = $this->_helper->getHelper('url');
	$this->_form = new Application_Form_Admin_NuovaAzienda_InserimentoNuovaAzienda();
        $this->_form->setAction($urlHelper->url(array(
				'controller' => 'admin',
				'action' => 'inserimentoazienda'),
				'default'
				));
	return $this->_form;
    }
    
    /*Metrodo che ritorna la form*/
    private function getInserisciTipologiaForm() {
	$urlHelper = $this->_helper->getHelper('url');
	$this->_form = new Application_Form_Admin_NuovaTipologia_InserimentoNuovaTipologia();
        $this->_form->setAction($urlHelper->url(array(
				'controller' => 'admin',
				'action' => 'inserimentotipologia'),
				'default'
				));
	return $this->_form;
    }
}