<?php
/*Controller da copiare*/
class PublicController extends Zend_Controller_Action {
    
    protected $_logger;
    protected $_PublicModel;
    protected $_authService;
    protected $_formRegistrazione;
    protected $nomeDaCercare;
    protected $catId;
    protected $_loginform;
    protected $_searchform;
    protected $_formfiltratipologia;
    protected $_filtraformaziendaform;
    protected $_filtratipologiaformS;
    protected $_filtraAziendaFormS;
    

    
    
    //funzione che si avvia alla creazione dell'oggetto controller
    public function init() {
        

        $this->_helper->layout->setLayout('layoutstatic');
        $this->_logger = Zend_Registry::get("log"); //file log

        
        $this->_PublicModel = new Application_Model_Public(); //model
        
        /*istanzio le form */
        $this->view->accediForm = $this->getAccediForm();
        $this->view->registraForm = $this->getRegistraForm();
        $this->view->filtraAziendaFormS = $this->getFiltraAziendaFormS();
        $this->view->filtraTipologiaFormS = $this->getFiltraTipologiaFormS();
        $this->view->searchForm = $this->getSearchForm();
        $this->view->filtraAziendaTipologia = $this->getFiltraAziendaFormTipologia();
        
        //Creo l'oggetto Auth
        $this->_authService = new Application_Service_Auth();
        
    }
    
    
    public function indexAction() {
        
        /*Disabilito il layout perchè viene caricata la pagina di Benvenuto*/
        $this->_helper->layout->disableLayout();
        
    }
    
    /*azione sul click di info sull'offerta*/
    public function informazioneoffertaAction() {
      
        
      $this->_logger->info('Attivato ' . __METHOD__ . ' ');
        
      $param = $this->_getParam('offertaid');
      $infofferta = $this->_PublicModel->getPromozioneById($param);
      $this->_logger->debug(print_r($infofferta, true));
      $this->view->assign(array('offerta'=>$infofferta));

    }
    
    


    /*Pagina dell'azienda*/

     public function profilobrandsAction() {
         
        $this->_logger->info('Attivato ' . __METHOD__ . ' ');
          
        $param= $this->_getParam('nomeazienda');   
        $infoazienda = $this->_PublicModel->getAziendaByNome($param);
        $this->view->assign(array('infoazienda'=>$infoazienda));
            
    }
    

    /*Pagina con tutte le aziende*/

    public function paginadeibrandsAction(){
        
        $this->_logger->info('Attivato ' . __METHOD__ . ' ');
        
        $this->_helper->layout->setLayout('main');
        $id = $this->_getParam('idazienda',1);
        $paged = $this->_getParam('page',1);
        $listaazienda = $this->_PublicModel->getAzienda();
        $brands = $this->_PublicModel->getAziendaById($id)->toArray();
        $offerte = $this->_PublicModel->getPromozioneByIdAzienda($id, $paged);
        
        $this->view->assign(array('paginadeibrands'=>$listaazienda,'brands'=>$brands,'offerte'=>$offerte));

        
    }
    
    
    /*Pagina FAQ*/
    public function paginafaqAction(){
        //log
        $this->_logger->info('Attivato ' . __METHOD__ . ' ');
        
        $this->_helper->layout->setLayout('main');
        $faq = $this->_PublicModel->getFaq();
       
        $this->view->assign(array('paginafaq'=>$faq));
        
    }
    
    /*Azione sulle pagine statiche*/
    public function viewstaticAction() {
        

        //log
       
        $this->_logger->info('Attivato ' . __METHOD__ . ' ');
        $this->_helper->layout->setLayout('layoutstatic');
        $page = $this->_getParam('staticPage');
        $this->render($page);
    
    }


    /*Azione per attivare la homepage*/
    public function homeAction() {
        
      
        //log
        $this->_logger->info('Attivato ' . __METHOD__ . ' ');
        $this->_helper->layout->setLayout('main');
        
        /*Prendo la pagina da offerte del giorno e offerte in scadenza*/
        $pagedScadenza = $this->_getParam('pageScadenza',1);
        
        //Estraggo dal DB la promozione in scadenza
        $offertaInScadenza = $this->_PublicModel->getPromozioniInscadenza($pagedScadenza,null);

        //Estraggo le tipologi
        $tipologie = $this->_PublicModel->getTipologie();
        //Assegno alla view i prodotto da visualizzare
        $this->view->assign(array('offerteInScadenza'=>$offertaInScadenza,'tipologie'=>$tipologie));


      
    }
    /*pagina categorie*/
   public function categorieAction () {
       
        //log
        $this->_logger->info('Attivato ' . __METHOD__ . ' ');
        $this->_helper->layout->setLayout('main');
        $tipologie = $this->_PublicModel->getTipologie();
        $catId = $this->_getParam('catId', null);        
        /*Prendo pagina e la categoria selezionata dal database*/
        $pagedCategoria = $this->_getParam('pageCategoria',1);
        $offertaPerCategoria = $this->_PublicModel->getPromozioneByCategoria($catId,$pagedCategoria);
        
        $this->view->assign(array('offertaPerCategoria'=>$offertaPerCategoria,'tipologie'=>$tipologie,'tipologiaselezionata'=>$catId));
      
             
      
        
   }
   /*pagina categorie + filtro sull'azienda*/
   public function categoriefiltrateAction() {
       
       
       if ($this->getRequest()->isPost()) {
            
           $formFiltro = $this->_filtraformaziendaform;
           $_SESSION['azienda'] = null;
           $_SESSION['cat'] = null;
            if (!$formFiltro->isValid($_POST)) {
                
                return $this->render('categoriefiltrate');
            }
       }
        
        $pagedCategoria = $this->_getParam('pageCategoria',1);  
        if(!isset($_SESSION['azienda'])){
            
            $_SESSION['azienda'] = $formFiltro->getValue('Filtro');
            $_SESSION['cat'] = $this->_getParam('catId', null);  
          
        }
        
        $tipologie = $this->_PublicModel->getTipologie();
        $offertaPerCategoria = $this->_PublicModel->getPromozioneByTipologiaAzienda($_SESSION['cat'],$_SESSION['azienda'],$pagedCategoria);
        $this->view->assign(array('offertaPerCategoria'=>$offertaPerCategoria,'tipologie'=>$tipologie,'tipologiaselezionata'=>$_SESSION['cat'],
                                  'nomecercato'=>$_SESSION['azienda']));
       
        
   }
   
    /*Azione sulle offerte*/
    public function offerteAction() {
        
        
  
    }

    /*Collegato alla pagina registrazione*/
    public function registrazioneAction(){
        
        
    }
    
    //funzione per la registrazione
    public function registrautenteAction(){
        
        $request = $this->getRequest();
        $this->_logger->info('Attivato ' . __METHOD__ . ' ');
       
     
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('home');
        }
        
        $formRegistrazione = $this->_formRegistrazione;
        
        if (!$formRegistrazione->isValid($request->getPost())){
            
            $this->_logger->info('Attivato If della form registrazione');
            $formRegistrazione->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            $this->_logger->debug(print_r($formRegistrazione->getErrors(), true));
            return $this->render('registrazione');
            
        
        }
        
        $values = $formRegistrazione->getValues();
        $values['role']="user"; 

        /*Blocco Try-Catch che cattura l'eccezione riguardante un username già presente*/
        try{
            $this->_PublicModel->insertUser($values);
            $formRegistrazione->setDescription('Registrazione effettuata con successo!');
            $this->_helper->redirector('home');
            
        }
        catch(Exception $e){
            $formRegistrazione->setDescription('ATTENZIONE! Username già presente!');
            $this->render('registrazione');
        }
        
        
        
    }
    

        
    //funzione per la ricerca
    public function ricercaAction() {
        
    /*variabile session usata per memorizzare i dati*/
        if ($this->getRequest()->isGet()) {
             $formRicerca = $this->_searchform;
             $_SESSION['nomedacercare'] = null;
             $_SESSION['scelta'] = null;
             if (!$formRicerca->isValid($_GET)) {
                    return $this->render('home');
            }
        }
        $this->_helper->layout->setLayout('main');
        $tipologie = $this->_PublicModel->getTipologie();
        $pagedRicerca = $this->_getParam('pageRicerca',1);
        //se non sono impostati, viene settata per la prima volta
        if(!isset($_SESSION['nomedacercare'])){
            
            $_SESSION['nomedacercare'] = $_GET['cercaOfferta'];
            $_SESSION['scelta'] = $_GET['selezione'];
        }
        $this->_logger->info('SESSIONE '.print_r($_SESSION,true));

        //splitto le parole in un array
        $parole = preg_split("/[\s,]+/", $_SESSION['nomedacercare']);
        $offertaRicercata = $this->_PublicModel->cercaPromozione($_SESSION['scelta'], $parole, $pagedRicerca);

        $this->view->assign(array('offertaRicercata'=>$offertaRicercata,'tipologie'=>$tipologie,'nomedacercare'=>$_SESSION['nomedacercare']));
        
    }
    
    
 
    //funzione per ottenere la form registra
    private function getRegistraForm() {
        
	$urlHelper = $this->_helper->getHelper('url');
	$this->_formRegistrazione = new Application_Form_Public_Registrazione_Registra();
        $this->_formRegistrazione->setAction($urlHelper->url(array(
				'controller' => 'public',
				'action' => 'registrautente'),
				'default'
				));
	return $this->_formRegistrazione;
    }
    
    //funzione per la form ricerca
    private function getSearchForm() {
        
        $urlHelper = $this->_helper->getHelper('url');
	$this->_searchform = new Application_Form_Public_Search_Searchofferta();
        $this->_searchform->setAction($urlHelper->url(array(
				'controller' => 'public',
				'action' => 'ricerca'),
				'default'
				));
	return $this->_searchform;
    }
    
    /*Pagina di login*/
    public function loginAction() {
        
       
    }
    
    //Funzione che fa l'autenticazione prendendo i valori dalla form
    public function autenticazioneAction() {        
        
        $request = $this->getRequest();
        
        if (!$request->isPost()) {
            return $this->_helper->redirector('login');
        }
        $formLogin = $this->_loginform;
        $formaData = $this->getRequest()->getPost();
        
        if (!$formLogin->isValid($formaData)) {
            
            $this->_logger->info('Attivato If della form login');
            $this->_logger->info($formLogin->getValues());
            $formLogin->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('login');
        }
        if (false === $this->_authService->authenticate($formLogin->getValues())) {
            
            $formLogin->setDescription('Autenticazione fallita. Riprova');
            return $this->render('login');
        }
        //reindirizza all'index del controller del tipo di utente che ha fatto login
        return $this->_helper->redirector('index', $this->_authService->getIdentity()->role);
        
     }
    /*Ajax Validator per il login*/ 
    public function validaloginAction() {
        
        $this->_helper->getHelper('layout')->disableLayout();
    		$this->_helper->viewRenderer->setNoRender();

        $accediform = new Applicazion_Form_Public_Login_Accedi();
        $response = $accediform->processAjax($_POST); 
        if ($response !== null) {
            
        	$this->getResponse()->setHeader('Content-type','application/json')->setBody($response);        	
        }
    }
    /*Ajax Validator per la registrazione*/
    public function validaregistrazioneAction() {
        $this->_helper->getHelper('layout')->disableLayout();
    	$this->_helper->viewRenderer->setNoRender();
            
        $registrazioneform = new Application_Form_Public_Registrazione_Registra();
        $response = $registrazioneform->processAjax($_POST);
        
        if ($response !== null) {
        	$this->getResponse()->setHeader('Content-type','application/json')->setBody($response);        	
        }
    }
	

    /*Metodo che ritorna la form*/    
    private function getAccediForm() {
	$urlHelper = $this->_helper->getHelper('url');
	$this->_loginform = new Application_Form_Public_Login_Accedi();
        $this->_loginform->setAction($urlHelper->url(array(
				'controller' => 'public',
				'action' => 'autenticazione'),
				'default'
				));
	return $this->_loginform;
    }

    /*Azione della form filtra per azienda offerte scadute*/
    public function filtroaziendaAction() {

        //utilizzo la variabile session per memorizzare i dati temporaneamente
        if ($this->getRequest()->isPost()) {
      
            $formFiltro=$this->_filtraAziendaFormS;
            $_SESSION['filtro']=null;
        
            if (!$formFiltro->isValid($_POST)) {
		
		return $this->render('home');
            }
        }
        //la imposto per la prima volta
        if(!isset($_SESSION['filtro'])){
            
            $_SESSION['filtro'] = $formFiltro->getValue('Filtro');
           
        }
       
     
        $paged = $this->_getParam('page',1);
        $offerte = $this->_PublicModel->getPromozioneByDateAzienda($_SESSION['filtro'],$paged);
        $this->view->assign(array('offerte'=>$offerte,'nomecercato'=>$_SESSION['filtro']));
        
    }
        
        
  
    
    /*Azione della form filtra per tipologia le offerte in scadenza*/
    public function filtrotipologiaAction() {
        
        //session usata per memorizzare i dati        
        if ($this->getRequest()->isPost()) {
         
            $formFiltro=$this->_filtratipologiaformS;
            $_SESSION['filtroAzienda']=null;
        
            if (!$formFiltro->isValid($_POST)) {
                
		$formFiltro->setDescription('Attenzione! dati inseriti non validi');
		return $this->render('home');
            }
        }
        //la imposto per la prima volta
        if(!isset($_SESSION['filtroAzienda'])){
            
            $_SESSION['filtroAzienda'] = $formFiltro->getValue('Filtro');
           
        }
       
   
        $paged = $this->_getParam('page',1);
        $offerte = $this->_PublicModel->getPromozioniInscadenzaTipologia($_SESSION['filtroAzienda'],$paged,null);
        $this->view->assign(array('offerte'=>$offerte,'nomecercato'=>$_SESSION['filtroAzienda']));
        

        
        
    }
    
     /*Filtro per azienda offerte scadenza*/
    private function getFiltraAziendaFormS() {
        
        $urlHelper = $this->_helper->getHelper('url');
	$this->_filtraAziendaFormS = new Application_Form_Public_Filtro_FiltroAzienda();
        $this->_filtraAziendaFormS->setAction($urlHelper->url(array(
				'controller' => 'public',
				'action' => 'filtroazienda',
                                'form'=>'filtroazienda'),
				'default'
				));
	return $this->_filtraAziendaFormS;
    }
    /*Filtro per tipologia offerte scadenza*/
    private function getFiltraTipologiaFormS() {
                
        $urlHelper = $this->_helper->getHelper('url');
	$this->_filtratipologiaformS = new Application_Form_Public_Filtro_FiltroTipologia();
        $this->_filtratipologiaformS ->setAction($urlHelper->url(array(
				'controller' => 'public',
				'action' => 'filtrotipologia',
                                'form'=>'filtrotipologia'),
				'default'
				));
	return $this->_filtratipologiaformS;
    }
    
    /*form per il filtra azienda in tipologia*/
    private function getFiltraAziendaFormTipologia() {
        

        $urlHelper = $this->_helper->getHelper('url');
	$this->_filtraformaziendaform = new Application_Form_Public_Filtro_FiltroAzienda();

        $this->_filtraformaziendaform->setAction($urlHelper->url(array(
				'controller' => 'public',
				'action' => 'categoriefiltrate'),
				'default'
				));
        
	return $this->_filtraformaziendaform;

    }
 
}

