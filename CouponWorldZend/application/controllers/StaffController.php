<?php
    
class StaffController extends Zend_Controller_Action {
    
    protected $_logger;
    protected $_StaffModel;
    protected $_authService;
    protected $_formInserimentoNuovaPromozione;
    protected $_modificaProfiloForm;
    protected $_modificaPromozioneForm;
        
   public function init() {
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
        
    public function indexAction(){
        
        
    }
        
    /* Pagina per l'inserimento della promozione */
    public function nuovapromozioneAction(){
        
    }
     
    //azione che elimina una promozione
    public function eliminapromozioneAction(){
        
        $idpromozione = $this->_getParam('idpromo');
        $this->_StaffModel->deletePromozione($idpromozione);
        $this->_helper->redirector('modificaeliminapromozione');
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
            
            $this->_helper->redirector('index');
                
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
        /*Blocco try catch per la gestione degli username*/
        try{
            
            
            $this->_StaffModel->updateUser($values,$id);
            $this->render('index');
                
        } catch (Exception $ex) {
            
            $form->setDescription('Attenzione: username già presente!');
            $this->_helper->redirector('index');
                
        }  
            
            
    }
        
    /*Azione della form che modifica la promozione*/
    public function modificapromozioneAction(){
        
        
        $this->_logger->info('Attivato ' . __METHOD__ . ' ');
            
            
        if (!$this->getRequest()->isPost()) {
            
            $this->_helper->redirector('modificaeliminapromozione');
                
        }
            
        $form = $this->_modificaPromozioneForm;
            
        $this->_logger->debug(print_r($form->getValues(), true));
            
        if (!$form->isValid($_POST)){
            
            
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            $this->_logger->debug(print_r($form->getErrors(), true));
            return $this->render('modificapromozionepage');
                
                
        }
            
        $values = $form->getValues();
        $id = $this->_getParam('id');
        $validita=$values['validita'];
        
        //prendo gli id dell'azienda e tipologia dal nome
        $idazienda = $this->_StaffModel->getIdAziendaByNome($values['selezionebrands']);
        $idtipologia = $this->_StaffModel->getIdTipologiaByNome($values['selezionetipologie']);
        //le salvo in due variabili
        $myid1=$idazienda->idazienda;
        $myid2=$idtipologia->idtipologia;
            
        /*cambia  il nome degli indici dentro e values e elimina i vecchi*/
        $values['azienda_idazienda']=$values['selezionebrands'];
        unset($values['selezionebrands']);
        $values['tipologia_idtipologia']=$values['selezionetipologie'];
        unset($values['selezionetipologie']);
        unset($values['validita']);
            
        /*inserisce dentro values gli id dell'azienda selezionata e della tipologia selezionata */
        $values['azienda_idazienda']=$myid1;
        $values['tipologia_idtipologia']=$myid2;
        
        //sommo alla data odierna i giorni di validità
        $NewDate=Date('y:m:d', strtotime("+$validita days"));
        $NewDateInizio=Date('y:m:d');
        
        $values['datafine']=$NewDate;
        $values['datainizio']=$NewDateInizio;
            
            
        $this->_StaffModel->updatePromozione($id,$values);
            
        $this->_helper->redirector('modificaeliminapromozione');
            
            
            
    }
        
        
    /*Azione sulla pagina modifica/elimina della promozione*/
    public function modificaeliminapromozioneAction(){
        
        $page = $this->_getParam('page',1);
        $offerte = $this->_StaffModel->getAllPromozione($page);
        $this->view->assign(array('promozione'=>$offerte));
            
    }
    //pagina per la modifica della promozione
    public function modificapromozionepageAction() {
        
        $id = $this->_getParam('idpromo');
        $urlHelper = $this->_helper->getHelper('url');
        $this->_modificaPromozioneForm->setAction($urlHelper->url(array(
				'controller' => 'staff',
				'action' => 'modificapromozione',
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
        
        
        
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('nuovapromozione');
        }
            
        $formInserimentoNuovaPromozione = $this->_formInserimentoNuovaPromozione;
            
            
        if (!$formInserimentoNuovaPromozione->isValid($_POST)){
            
            $formInserimentoNuovaPromozione->setDescription('ATTENZIONE! dati inseriti non validi!');
            $this->_logger->debug(print_r($formInserimentoNuovaPromozione->getErrors(), true));
            return $this->render('nuovapromozione');
                
                
        }
            
        /*estraggo le i valori dalle form */
        $values = $formInserimentoNuovaPromozione->getValues();
        $this->_logger->debug(print_r($values, true));
        $tipologia=$values['selezionetipologie'];
        $nomeazienda=$values['selezionebrands'];
        $validita=$values['validita'];
            
            
        /*estraggo gli id dell'azienda selezionata e della tipologia selezionata */
        $idazienda = $this->_StaffModel->getIdAziendaByNome($nomeazienda);
        $idtipologia = $this->_StaffModel->getIdTipologiaByNome($tipologia);
        $myid1=$idazienda->idazienda;
        $myid2=$idtipologia->idtipologia;
            
            
        /*cambia  il nome degli indici dentro e values e elimina i vecchi*/
        $values['azienda_idazienda']=$values['selezionebrands'];
        unset($values['selezionebrands']);
        $values['tipologia_idtipologia']=$values['selezionetipologie'];
        unset($values['selezionetipologie']);
        unset($values['validita']);
            
        /*inseriscie dentro values gli id dell'azienda selezionata e della tipologia selezionata */
        $values['azienda_idazienda']=$myid1;
        $values['tipologia_idtipologia']=$myid2;
        $NewDate=Date('y:m:d', strtotime("+$validita days"));
        $NewDateInizio=Date('y:m:d');
        $values['datafine']=$NewDate;
        $values['datainizio']=$NewDateInizio;
            
            
        $this->_StaffModel->insertPromozione($values);
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
     /*Metodo che ritorna la form*/    
    private function getModificaProfiloForm() {
        
        $this->_modificaProfiloForm = new Application_Form_Staff_ModificaProfilo_ModificaProfilo();
        return $this->_modificaProfiloForm;
    }
     /*Metodo che ritorna la form*/
    private function getModificaPromozioneForm(){
        
        $this->_modificaPromozioneForm = new Application_Form_Staff_ModificaOfferta_ModificaOfferta();
        return $this->_modificaPromozioneForm;
    }
    
    //azione di logout  
    public function logoutAction() {
         
        $this->_authService->clear();
        return $this->_helper->redirector('home','public');
    }
}