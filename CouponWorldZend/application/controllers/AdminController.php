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
        $this->_helper->layout->setLayout('layoutadmin');
        
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
   /* Pagina per la modifica dell'azienda */
    public function modificaaziendapageAction(){
        
         $id = $this->_getParam('idazienda');  
         $this->view->modificaFormAzienda = $this->getModificaAziendaForm($id);
    }
    
    
    /*Azione sulla pagina modifica/elimina azienda*/
    public function modificaeliminaaziendaAction() {
        
        $paged = $this->_getParam('page',1); 
        $listaAziende =  $this->_AdminModel->getAziende($paged);
        $this->view->assign(array('aziende'=>$listaAziende));
    }
    
    /*Azione sulla pagina modifica/elimina tipologie*/
    public function modificaeliminatipologiaAction() {
        $paged = $this->_getParam('page',1);
        $listatipologie = $this->_AdminModel->getTipologie($paged);
        $this->view->assign(array('tipologie'=>$listatipologie));
    }
    
    /*Azione sulla pagina modifica/elimina staff*/
    public function modificaeliminastaffAction() {
        $paged = $this->_getParam('page',1);
        $listastaff = $this->_AdminModel->getStaff($paged);
        $this->view->assign(array('staff'=>$listastaff));

    }
    
    /*Azione sulla pagina modifica/elimina domanda e risposta*/
    public function modificaeliminadomandarispostaAction() {
        $paged = $this->_getParam('page',1);
        $listafaq = $this->_AdminModel->getFaq($paged);
        $this->view->assign(array('faq'=>$listafaq));

    }
    
    /*Azione sulla pagina modifica/elimina un utente*/
    public function modificaeliminautenteAction() {
        $paged = $this->_getParam('page',1);
        $listaUtenti = $this->_AdminModel->getAllUser($paged);
        $this->view->assign(array('utenti'=>$listaUtenti));
    }
    
    /*Azione che elimina un utente*/
    public function eliminautenteAction() {
        $iduser = $this->_getParam('idutente');
        $this->_logger->info('id utente '.$iduser);
        $this->_AdminModel->deleteUser($iduser);
        $this->_helper->redirector('modificaeliminautente');
    }
    
    /*Azione che elimina un'azienda*/
    public function eliminaaziendaAction() {
        
        $id = $this->_getParam('idazienda');
        $this->_AdminModel->deleteAzienda($id);
        $this->_helper->redirector('modificaeliminaazienda');
    }
    
    /*Azione che elimina una faq*/
    public function eliminafaqAction() {
        
        $id = $this->_getParam('idfaq');
        $this->_AdminModel->deleteFaq($id);
        $this->_helper->redirector('modificaeliminadomandarisposta');
    }
    
    
    /*Azione che elimina uno staff*/    
    public function eliminastaffAction() {
        $id = $this->_getParam('idutente');
        $this->_AdminModel->deleteUser($id);
        $this->_helper->redirector('modificaeliminastaff');
    }
    
    /*Azione che elimina una tipologia*/    
    public function eliminatipologiaAction() {
        $id= $this->_getParam('idtipologia');
        $this->_AdminModel->deleteTipologia($id);
        $this->_helper->redirector('modificaeliminatipologia');
    }
    
 
    /*Azione che modifica una tipologia*/  
    public function modificaaziendaAction() {
        

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
        $formInserimentoTipologia =  new Application_Form_Admin_NuovaTipologia_InserimentoNuovaTipologia();
        
        if (!$formInserimentoTipologia->isValid($_POST)){
            
            $formInserimentoTipologia->setDescription('ATTENZIONE! dati inseriti non validi!');
            $this->_logger->info('Attivato If della form registrazione');
            $formInserimentoTipologia->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            $this->_logger->debug(print_r($formInserimentoTipologia->getErrors(), true));
            return $this->render('nuovaazienda');
            
        
        }
        $values = $formInserimentoTipologia->getValues();
        $this->_AdminModel->insertTipologia($values);
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
    
    
        /*Metrodo che ritorna la form*/
    private function getModificaAziendaForm($id) {
        
        $azienda = $this->_AdminModel->getAziendaById($id);
        $azienda = $azienda->toArray();
        $this->_logger->debug(print_r($azienda, true));
	$urlHelper = $this->_helper->getHelper('url');
	$this->_form = new Application_Form_Admin_ModificaAzienda_ModificaAzienda();
        $this->_form->populate($azienda);
        $this->_form->setAction($urlHelper->url(array(
				'controller' => 'admin',
				'action' => 'modificaazienda'),
				'default'
				));
	return $this->_form;
    }
    
    public function logoutAction() {
        
        $this->_authService->clear();
        return $this->_helper->redirector('home','public');
    }
}