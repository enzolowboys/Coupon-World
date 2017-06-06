<?php

class StaffController extends Zend_Controller_Action {
    
    protected $_logger;
    protected $_StaffModel;
    protected $_authService;
    protected $formInserimentoNuovaPromozione;
    
   public function init()
    {
        $this->_logger = Zend_Registry::get("log"); //file log
        $this->_helper->layout->setLayout('layoutstatic');
        
        $this->_StaffModel = new Application_Model_Staff(); //model
        
        /* azioni sulle form di inserimento */
        $this->view->nuovapromozioneForm = $this->getInserisciPromozioneForm();
        
        //Creo l'oggetto Auth
        $this->_authService = new Application_Service_Auth();
    }

    public function indexAction()
    {
        
       
    }
    
    /* Pagina per l'inserimento della promozione */
    public function nuovapromozioneAction(){
        
    }
    
    /*Azione sulla pagine modifica profilo user*/
    public function modificaprofiloAction(){
        
    }
    
    /*Azione sulla pagina modifica/elimina della promozione*/
    public function modificaeliminapromozioneAction(){
        
    }
    
    //funzione per l'inserimento di una nuova azienda
    public function inserimentopromozioneAction(){
        
        $this->_logger->info('Attivato ' . __METHOD__ . ' ');
       
     
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('home');
        }
        $formInserimentoNuovaPromozione =  new Application_Form_Staff_NuovaPromozione_InserimentoNuovaPromozione();
        
        if (!$formInserimentoNuovaPromozione->isValid($_POST)){
            
            $formInserimentoNuovaPromozione->setDescription('ATTENZIONE! dati inseriti non validi!');
            $this->_logger->info('Attivato If della form registrazione');
            $formInserimentoNuovaPromozione->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            $this->_logger->debug(print_r($formInserimentoNuovaPromozione->getErrors(), true));
            return $this->render('nuovaazienda');
            
        
        }
        $values = $formInserimentoNuovaPromozione->getValues();
        $this->_AdminModel->insertPromozione($values);
        $this->_helper->redirector('index');
    }
    
    
    /*Metrodo che ritorna la form*/
    private function getInserisciPromozioneForm() {
	$urlHelper = $this->_helper->getHelper('url');
	$this->_form = new Application_Form_Staff_NuovaPromozione_InserimentoNuovaPromozione();
        $this->_form->setAction($urlHelper->url(array(
				'controller' => 'staff',
				'action' => 'inserimentopromozione'),
				'default'
				));
	return $this->_form;
    }
}