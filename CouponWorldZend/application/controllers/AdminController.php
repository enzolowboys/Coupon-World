<?php

class AdminController extends Zend_Controller_Action {
    
    protected $_logger;
    protected $_AdminModel;
    protected $_authService;
    protected $formInserimentoNuovaAzienda;
    protected $formInserimentoTipologia;
    protected $formInserimentoStaff;
    protected $formInserimentoDomandaRisposta;
    
   public function init()
    {
        $this->_logger = Zend_Registry::get("log"); //file log
        $this->_helper->layout->setLayout('layoutstatic');
        
        $this->_AdminModel = new Application_Model_Admin(); //model
        
        /* azioni sulle form di inserimento */
        $this->view->nuovaaziendaForm = $this->getInserisciAziendaForm();
        $this->view->nuovatipologiaForm = $this->getInserisciTipologiaForm();
        $this->view->nuovostaffForm = $this->getInserisciStaffForm();
        $this->view->nuovadomandarispostaForm = $this->getInserisciDomandaRispostaForm();
        
        //Creo l'oggetto Auth
        $this->_authService = new Application_Service_Auth();
    }

    public function indexAction(){
        
    }
    
    /* Pagina per l'inserimento dell'azienda */
    public function nuovaaziendaAction(){
        
    }
    
    /* Pagina per l'inserimento della tipologia */
    public function nuovatipologiaAction(){
        
    }
    
    /* Pagina per l'inserimento dello staff */
    public function nuovostaffAction(){
        
    }
    
    /* Pagina per l'inserimento della faq (domanda e risposta) */
    public function nuovadomandarispostaAction(){
        
    }
    
    
    //funzione per l'inserimento di una nuova azienda
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
    
    //funzione per l'inserimento di una nuova tipologia
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
    
     //funzione per l'inserimento di un nuovo utente staff
    public function inserimentostaffAction(){
        $this->_logger->info('Attivato ' . __METHOD__ . ' ');
       
     
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('home');
        }
        $formInserimentoStaff =  new Application_Form_Admin_NuovoStaff_InserimentoNuovoStaff();
        
        if (!$formInserimentoStaff->isValid($_POST)){
            
            $formInserimentoStaff->setDescription('ATTENZIONE! dati inseriti non validi!');
            $this->_logger->info('Attivato If della form registrazione');
            $formInserimentoStaff->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            $this->_logger->debug(print_r($formInserimentoStaff->getErrors(), true));
            return $this->render('nuovostaff');
            
        
        }
        $values = $formInserimentoStaff->getValues();
        $this->_AdminModel->insertUser($values);
        $this->_helper->redirector('index');
    }
    
    //funzione per l'inserimento di un nuovo utente staff
    public function inserimentodomandarispostaAction(){
        $this->_logger->info('Attivato ' . __METHOD__ . ' ');
       
     
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('home');
        }
        $formInserimentoDomandaRisposta =  new Application_Form_Admin_NuovaDomandaRisposta_InserimentoNuovaDomandaRisposta();
        
        if (!$formInserimentoDomandaRisposta->isValid($_POST)){
            
            $formInserimentoDomandaRisposta->setDescription('ATTENZIONE! dati inseriti non validi!');
            $this->_logger->info('Attivato If della form registrazione');
            $formInserimentoDomandaRisposta->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            $this->_logger->debug(print_r($formInserimentoDomandaRisposta->getErrors(), true));
            return $this->render('nuovadomandarisposta');
            
        
        }
        $values = $formInserimentoDomandaRisposta->getValues();
        $this->_AdminModel->insertFaq($values);
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
    
     /*Metrodo che ritorna la form*/
    private function getInserisciStaffForm() {
	$urlHelper = $this->_helper->getHelper('url');
	$this->_form = new Application_Form_Admin_NuovoStaff_InserimentoNuovoStaff();
        $this->_form->setAction($urlHelper->url(array(
				'controller' => 'admin',
				'action' => 'inserimentostaff'),
				'default'
				));
	return $this->_form;
    }
    
    /*Metrodo che ritorna la form*/
    private function getInserisciDomandaRispostaForm() {
	$urlHelper = $this->_helper->getHelper('url');
	$this->_form = new Application_Form_Admin_NuovaDomandaRisposta_InserimentoNuovaDomandaRisposta();
        $this->_form->setAction($urlHelper->url(array(
				'controller' => 'admin',
				'action' => 'inserimentodomandarisposta'),
				'default'
				));
	return $this->_form;
    }
}