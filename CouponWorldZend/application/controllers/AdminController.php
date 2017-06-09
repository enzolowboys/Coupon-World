<?php

class AdminController extends Zend_Controller_Action {
    
    protected $_logger;
    protected $_AdminModel;
    protected $_authService;
    protected $_formInserimentoNuovaAzienda;
    protected $_formInserimentoTipologia;
    protected $_formInserimentoStaff;
    protected $_formInserimentoDomandaRisposta;
    protected $_modificaAziendaForm;
    protected $_modificaUtenteForm;
    protected $_modificaTipologiaForm;
    protected $_modificaStaffForm;
    protected $_modificaFaqForm;
    
    public function init() {
       
        $this->_logger = Zend_Registry::get("log"); //file log
        $this->_helper->layout->setLayout('layoutadmin');
        
        $this->_AdminModel = new Application_Model_Admin(); //model
        
        /* azioni sulle form di inserimento */
        $this->view->nuovaaziendaForm = $this->getInserisciAziendaForm();
        $this->view->nuovatipologiaForm = $this->getInserisciTipologiaForm();
        $this->view->nuovostaffForm = $this->getInserisciStaffForm();
        $this->view->nuovadomandarispostaForm = $this->getInserisciDomandaRispostaForm();
        $this->view->modificaFormAzienda = $this->getModificaAziendaForm();
        $this->view->modificaUtenteForm = $this->getModificaUtenteForm();
        $this->view->modificaTipologiaForm = $this->getModificaTipologia();
        $this->view->modificaStaffForm = $this->getModificaStaffForm();
        $this->view->modificaFaqForm = $this->getModificaFaqForm();
       
       
        
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
    

    /*Pagina che visualizza le promozioni di cui vedere la statistica*/
    public function statistichepromozionipageAction(){
        
        $paged1 = $this->_getParam('page1',1);
        $paged2 = $this->_getParam('page2',1);
        $promozioni = $this->_AdminModel->getAllPromozione($paged1);
        $utenti = $this->_AdminModel->getAllUser($paged2);
        $numeroCoupon = $this->_AdminModel->getNumeroCoupon();
        foreach ($promozioni as $promozione) {
            
             $result1 = $this->_AdminModel->getNumeroCouponPromozione($promozione->idpromozione);
             $numeroCouponPerPromozione[$promozione->idpromozione] = $result1;
             
             
        }
        foreach ($utenti as $utente) {
            
             $result2 = $this->_AdminModel->getNumeroCouponUtente($utente->iduser);
             $numeroCouponPerUtente[$utente->iduser] = $result2;
          
             
        }
      
        $this->view->assign(array('promozione'=>$promozioni,'utenti'=>$utenti, 'numerocouponpromo'=>$numeroCouponPerPromozione,
            'numerocoupontotali'=>$numeroCoupon,'numerocouponutenti'=>$numeroCouponPerUtente));
      
        
    }
    

  
    
   /* Pagina per la modifica dell'azienda */
    public function modificaaziendapageAction(){
        
         $id = $this->_getParam('idazienda');
         $urlHelper = $this->_helper->getHelper('url');
         $this->_modificaAziendaForm->setAction($urlHelper->url(array(
				'controller' => 'admin',
				'action' => 'modificaazienda',
                                'id'=>$id),
				'default'
				));
         $azienda = $this->_AdminModel->getAziendaById($id);
         $azienda = $azienda->toArray();
         $this->_modificaAziendaForm->populate($azienda);
       
    }
    
    /* Pagina per la modifica dell'utente */
    public function modificautentepageAction(){
        
        $id = $this->_getParam('iduser');
        $urlHelper = $this->_helper->getHelper('url');
        $this->_modificaUtenteForm->setAction($urlHelper->url(array(
				'controller' => 'admin',
				'action' => 'modificautente',
                                'id'=>$id),
				'default'
				));
        $utente = $this->_AdminModel->getUserById($id);
        $utente = $utente->toArray();
        $this->_modificaUtenteForm->populate($utente);
             
    }
    
    
    /* Pagina per la modifica della tipologia */
    public function modificatipologiapageAction(){
        
        $id = $this->_getParam('idtipologia');
        $urlHelper = $this->_helper->getHelper('url');
        $this->_modificaTipologiaForm->setAction($urlHelper->url(array(
				'controller' => 'admin',
				'action' => 'modificatipologia',
                                'id'=>$id),
				'default'
				));
        $tipologia = $this->_AdminModel->getTipologiaById($id);
        $tipologia = $tipologia->toArray();
        $this->_modificaTipologiaForm->populate($tipologia);
        
    }
    
    /* Pagina per la modifica dello staff */
    public function modificastaffpageAction(){
        
        $id = $this->_getParam('iduser');
        $urlHelper = $this->_helper->getHelper('url');
        $this->_modificaStaffForm->setAction($urlHelper->url(array(
				'controller' => 'admin',
				'action' => 'modificastaff',
                                'id'=>$id),
				'default'
				));
        $utente = $this->_AdminModel->getUserById($id);
        $utente = $utente->toArray();
        $this->_modificaStaffForm->populate($utente);
        
    }
    
    public function modificafaqpageAction(){
        
                
        $id = $this->_getParam('idfaq');
        $urlHelper = $this->_helper->getHelper('url');
        $this->modificaFaqForm->setAction($urlHelper->url(array(
				'controller' => 'admin',
				'action' => 'modificafaq',
                                'id'=>$id),
				'default'
				));
        $faq = $this->_AdminModel->getFaqById($id);
        $faq = $faq->toArray();
        $this->_modificaFaqForm->populate($faq);
        
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
    
 
    /*Azione che modifica una azienda*/  
    public function modificaaziendaAction() {
        
         $this->_logger->info('Attivato ' . __METHOD__ . ' ');
       
     
        if (!$this->getRequest()->isPost()) {
            
            $this->_helper->redirector('modificaaziendapage');
            
        }
        
        $form = $this->_modificaAziendaForm;
        
        $this->_logger->debug(print_r($form->getValues(), true));
  
        if (!$form->isValid($_POST)){
            

            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            $this->_logger->debug(print_r($form->getErrors(), true));
            return $this->render('modificaaziendapage');
            
        
        }

        $values = $form->getValues();
        $id = $this->_getParam('id');
        $this->_AdminModel->updateAzienda($values,$id);
        $this->_helper->redirector('modificaeliminaazienda');
    }
    
    /*Azione che modifica un utente*/
    public function modificautenteAction(){
        
        $this->_logger->info('Attivato ' . __METHOD__ . ' ');
       
     
        if (!$this->getRequest()->isPost()) {
            
            $this->_helper->redirector('modificautentepage');
            
        }
        
        $form = $this->_modificaUtenteForm;
        
        $this->_logger->debug(print_r($form->getValues(), true));
  
        if (!$form->isValid($_POST)){
            
            $form->setDescription('ATTENZIONE! dati inseriti non validi!');
            $this->_logger->info('Attivato If della form registrazione');
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            $this->_logger->debug(print_r($form->getErrors(), true));
            return $this->render('modificautentepage');
            
        
        }

        $values = $form->getValues();
        $id = $this->_getParam('id');
        
        $this->_AdminModel->updateUser($values,$id);
        $this->_helper->redirector('modificaeliminautente');
        
    }
    
    /*Azione che modifica una tipologia*/
    public function modificatipologiaAction(){
        
         $this->_logger->info('Attivato ' . __METHOD__ . ' ');
       
     
        if (!$this->getRequest()->isPost()) {
            
            $this->_helper->redirector('modificatipologiapage');
            
        }
        
        $form = $this->_modificaTipologiaForm;
        
        $this->_logger->debug(print_r($form->getValues(), true));
  
        if (!$form->isValid($_POST)){
            
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            $this->_logger->debug(print_r($form->getErrors(), true));
            return $this->render('modificatipologiapage');
            
        
        }

        $values = $form->getValues();
        $id = $this->_getParam('id');
        
        $this->_AdminModel->updateTipologia($values,$id);
        $this->_helper->redirector('modificaeliminatipologia');
        
    }
    
    /*Azione che modifica lo staff*/
    public function modificastaffAction() {
        
                
        $this->_logger->info('Attivato ' . __METHOD__ . ' ');
       
     
        if (!$this->getRequest()->isPost()) {
            
            $this->_helper->redirector('modificastaffpage');
            
        }
        
        $form = $this->_modificaStaffForm;
        
        $this->_logger->debug(print_r($form->getValues(), true));
  
        if (!$form->isValid($_POST)){
            
            $form->setDescription('ATTENZIONE! dati inseriti non validi!');
            $this->_logger->debug(print_r($form->getErrors(), true));
            return $this->render('modificastaffpage');
            
        
        }

        $values = $form->getValues();
        $id = $this->_getParam('id');
        
        $this->_AdminModel->updateUser($values,$id);
        $this->_helper->redirector('modificaeliminastaff');
        
        
    }
    
    /*Azione che modifica la faq*/
    public function modificafaqAction(){
        
        $this->_logger->info('Attivato ' . __METHOD__ . ' ');
       
     
        if (!$this->getRequest()->isPost()) {
            
            $this->_helper->redirector('modificafaqpage');
            
        }
        
        $form = $this->_modificaFaqForm;
        
        $this->_logger->debug(print_r($form->getValues(), true));
  
        if (!$form->isValid($_POST)){
            
            $form->setDescription('ATTENZIONE! dati inseriti non validi!');
            $this->_logger->debug(print_r($form->getErrors(), true));
            return $this->render('modificafaqpage');
            
        
        }

        $values = $form->getValues();
        $id = $this->_getParam('id');
        
        $this->_AdminModel->updateFaq($values,$id);
        $this->_helper->redirector('modificaeliminafaq');
        
    }

    //funzione per l'inserimento di una nuova azienda
    public function inserimentoaziendaAction(){
        
        $this->_logger->info('Attivato ' . __METHOD__ . ' ');
       
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('home');
        }
        $formInserimentoNuovaAzienda =  $this->_formInserimentoNuovaAzienda;
        
        if (!$formInserimentoNuovaAzienda->isValid($_POST)){
            
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
        $formInserimentoTipologia =  $this->_formInserimentoTipologia;
        
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
        $formInserimentoStaff =  $this->_formInserimentoStaff;
        
        if (!$formInserimentoStaff->isValid($_POST)){
            
            $formInserimentoStaff->setDescription('ATTENZIONE! dati inseriti non validi!');
            $this->_logger->info('Attivato If della form registrazione');
            $formInserimentoStaff->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            $this->_logger->debug(print_r($formInserimentoStaff->getErrors(), true));
            return $this->render('nuovostaff');
            
        
        }
        $values = $formInserimentoStaff->getValues();
        $values['role']="staff"; 
        $this->_AdminModel->insertUser($values);
        $this->_helper->redirector('index');
    }
    
    //funzione per l'inserimento di un nuovo utente staff
    public function inserimentodomandarispostaAction(){
        
        $this->_logger->info('Attivato ' . __METHOD__ . ' ');
       
     
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('home');
        }
        $formInserimentoDomandaRisposta =  $this->_formInserimentoDomandaRisposta;
        
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
	$this->_formInserimentoNuovaAzienda = new Application_Form_Admin_NuovaAzienda_InserimentoNuovaAzienda();
        $this->_formInserimentoNuovaAzienda->setAction($urlHelper->url(array(
				'controller' => 'admin',
				'action' => 'inserimentoazienda'),
				'default'
				));
	return $this->_formInserimentoNuovaAzienda;
    }
    
    /*Metrodo che ritorna la form*/
    private function getInserisciTipologiaForm() {
        
	$urlHelper = $this->_helper->getHelper('url');
	$this->_formInserimentoTipologia = new Application_Form_Admin_NuovaTipologia_InserimentoNuovaTipologia();
        $this->_formInserimentoTipologia->setAction($urlHelper->url(array(
				'controller' => 'admin',
				'action' => 'inserimentotipologia'),
				'default'
				));
	return $this->_formInserimentoTipologia;
    }
    
     /*Metrodo che ritorna la form*/
    private function getInserisciStaffForm() {
        
	$urlHelper = $this->_helper->getHelper('url');
	$this->_formInserimentoStaff = new Application_Form_Admin_NuovoStaff_InserimentoNuovoStaff();
        $this->_formInserimentoStaff->setAction($urlHelper->url(array(
				'controller' => 'admin',
				'action' => 'inserimentostaff'),
				'default'
				));
	return $this->_formInserimentoStaff;
    }
    
    /*Metrodo che ritorna la form*/
    private function getInserisciDomandaRispostaForm() {
        
	$urlHelper = $this->_helper->getHelper('url');
	$this->_formInserimentoDomandaRisposta = new Application_Form_Admin_NuovaDomandaRisposta_InserimentoNuovaDomandaRisposta();
        $this->_formInserimentoDomandaRisposta->setAction($urlHelper->url(array(
				'controller' => 'admin',
				'action' => 'inserimentodomandarisposta'),
				'default'
				));
	return $this->_formInserimentoDomandaRisposta;
    }
    
    /*Metrodo che ritorna la form*/
    private function getModificaAziendaForm() {

	$this->_modificaAziendaForm = new Application_Form_Admin_ModificaAzienda_ModificaAzienda();

	return $this->_modificaAziendaForm;
    }

    /*Metodo che ritorna la form*/
    private function getModificaUtenteForm(){
        
        $this->_modificaUtenteForm = new Application_Form_Admin_ModificaUtente_ModificaUtente();
        return $this->_modificaUtenteForm;
    }
    
     /*Metodo che ritorna la form*/
    private function getModificaTipologia() {
        $this->_modificaTipologiaForm = new Application_Form_Admin_ModificaTipologia_ModificaTipologia();
        return $this->_modificaTipologiaForm;
    }
    
    /*Metodo che ritorna la form*/
    private function getModificaStaffForm(){
        
        $this->_modificaStaffForm = new Application_Form_Admin_ModificaStaff_ModificaStaff();
        return $this->_modificaStaffForm;
        
    }
    
    /*Metodo che ritorna la form*/    
    private function getModificaFaqForm() {
        
        $this->_modificaFaqForm = new Application_Form_Admin_ModificaFaq_ModificaFaq();
        return $this->_modificaFaqForm;
    }
    
    
        
    public function logoutAction() {
        
        $this->_authService->clear();
        return $this->_helper->redirector('home','public');
    }
}