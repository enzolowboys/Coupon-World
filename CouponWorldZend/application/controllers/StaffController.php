<?php

class StaffController extends Zend_Controller_Action {
    
    protected $_logger;
    protected $_StaffModel;
    protected $_authService;
    protected $_formInserimentoNuovaPromozione;
    protected $_modificaProfiloForm;
    protected $_modificaPromozioneForm;
    
   public function init()
    {
        $this->_logger = Zend_Registry::get("log"); //file log
        $this->_helper->layout->setLayout('layoutstaff');
        
        $this->_StaffModel = new Application_Model_Staff(); //model
        
        /* azioni sulle form di inserimento */
        $this->view->nuovapromozioneForm = $this->getInserisciPromozioneForm();
        $this->view->modificaProfiloForm = $this->getModificaProfiloForm();
        $this->view->modificaPromozioneForm = $this->getModificaPromozioneForm();
        
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
    public function modificaprofilopageAction(){
        
        $id = $this->_authService->getIdentity()->iduser;
        $urlHelper = $this->_helper->getHelper('url');
        $this->_modificaProfiloForm->setAction($urlHelper->url(array(
				'controller' => 'staff',
				'action' => 'modificaprofilo',
                                'id'=>$id),
				'default'
				));
        $utente = $this->_StaffModel->getUserById($id);
        $utente = $utente->toArray();
        $this->view->assign(array('utente'=>$utente));
        $this->_modificaProfiloForm->populate($utente);
    }
   
    /*Azione della form che modifica il profilo*/
    public function modificaprofiloAction(){
        
                
        $this->_logger->info('Attivato ' . __METHOD__ . ' ');
       
     
        if (!$this->getRequest()->isPost()) {
            
            $this->_helper->redirector('modificaprofilopage');
            
        }
        
        $form = $this->_modificaProfiloForm;
        
        $this->_logger->debug(print_r($form->getValues(), true));
  
        if (!$form->isValid($_POST)){
            
          
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            $this->_logger->debug(print_r($form->getErrors(), true));
            return $this->render('modificaprofilopage');
            
        
        }

        $values = $form->getValues();
        $id = $this->_getParam('id');
        
        $this->_StaffModel->updateUser($values,$id);
        $this->_helper->redirector('modificaprofilopage');
    }
    
    
    /*Azione sulla pagina modifica/elimina della promozione*/
    public function modificaeliminapromozioneAction(){
        
        $offerte = $this->_StaffModel->getAllPromozione();
        $this->view->assign(array('promozione'=>$offerte));
        
    }
    public function modificapromozioneAction() {
        
        $id = $this->_getParam('idpromo');
        $urlHelper = $this->_helper->getHelper('url');
        $this->_modificaProfiloForm->setAction($urlHelper->url(array(
				'controller' => 'staff',
				'action' => 'modificaprofilo',
                                'id'=>$id),
				'default'
				));
        $offerta = $this->_StaffModel->getPromozioneById($id);
        $offerta = $offerta->toArray();
        $this->_logger->debug('array: ');
        $this->_logger->debug(print_r($offerta, true));
        $this->_modificaPromozioneForm->populate($offerta);
        $this->_modificaPromozioneForm->getElement('selezionetipologie')->setValue($offerta['nometipologia']);
        $this->_modificaPromozioneForm->getElement('selezionebrands')->setValue($offerta['nome']);
    }
    
    //funzione per l'inserimento di una nuova azienda
    public function inserimentopromozioneAction(){
        
        $this->_logger->info('Attivato ' . __METHOD__ . ' ');
       
     
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('home');
        }
        $formInserimentoNuovaPromozione = $this->_formInserimentoNuovaPromozione;
        
        if (!$formInserimentoNuovaPromozione->isValid($_POST)){
            
            $formInserimentoNuovaPromozione->setDescription('ATTENZIONE! dati inseriti non validi!');
            $this->_logger->debug(print_r($formInserimentoNuovaPromozione->getErrors(), true));
            return $this->render('nuovaazienda');
            
        
        }
        $values = $formInserimentoNuovaPromozione->getValues();
        $this->_AdminModel->insertPromozione($values);
        $this->_helper->redirector('index');
    }
    
    
    /*Metodo che ritorna la form*/
    private function getInserisciPromozioneForm() {
	$urlHelper = $this->_helper->getHelper('url');
	$this->_formInserimentoNuovaPromozione = new Application_Form_Staff_NuovaPromozione_InserimentoNuovaPromozione();
        $this->_formInserimentoNuovaPromozione->setAction($urlHelper->url(array(
				'controller' => 'staff',
				'action' => 'inserimentopromozione'),
				'default'
				));
	return $this->_formInserimentoNuovaPromozione;
    }
    
    private function getModificaProfiloForm() {
        
        $this->_modificaProfiloForm = new Application_Form_Staff_ModificaProfilo_ModificaProfilo();
        return $this->_modificaProfiloForm;
    }
    private function getModificaPromozioneForm(){
        
        $this->_modificaPromozioneForm = new Application_Form_Staff_ModificaOfferta_ModificaOfferta();
        return $this->_modificaPromozioneForm;
    }
    
     public function logoutAction() {
        
        $this->_authService->clear();
        return $this->_helper->redirector('home','public');
    }
}