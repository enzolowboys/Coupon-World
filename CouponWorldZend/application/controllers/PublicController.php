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
    

    
    
    
    public function init() {
        

        $this->_helper->layout->setLayout('layoutstatic');
        $this->_logger = Zend_Registry::get("log"); //file log

        
        $this->_PublicModel = new Application_Model_Public(); //model
       /* istanzio le form */
        $this->view->accediForm = $this->getAccediForm();
        
        $this->view->registraForm = $this->getRegistraForm();
        
        //Inizializzazione form
        $this->view->filtraAziendaFormS = $this->getFiltraAziendaFormS();
        $this->view->filtraTipologiaFormS = $this->getFiltraTipologiaFormS();
        

        
        $this->view->searchForm = $this->getSearchForm();
        
        //Creo l'oggetto Auth
        $this->_authService = new Application_Service_Auth();
        
    }
    
    /*Override del metodo di IndexController*/
    public function indexAction() {
        
        /*Disabilito il layout perchè viene caricata la pagina di Benvenuto*/
        $this->_helper->layout->disableLayout();
        
    }
    
    
    public function informazioneoffertaAction(){
      
        
      $this->_logger->info('Attivato ' . __METHOD__ . ' ');
        
      $param= $this->_getParam('offertaid');
        
      $this->_logger->info($param);
        
      $infofferta = $this->_PublicModel->getPromozioneById($param);
      $this->_logger->debug(print_r($infofferta, true));
      $this->view->assign(array('infofferta'=>$infofferta));

    }
    
    

     public function profilobrandsAction(){
         
      $this->_logger->info('Attivato ' . __METHOD__ . ' ');
        
        $param= $this->_getParam('nomeazienda');
        
         $this->_logger->info($param);
        
         $infoazienda = $this->_PublicModel->getAziendaByNome($param);
     $this->view->assign(array('infoazienda'=>$infoazienda));

    }


    /*Azione per attivare la homepage*/
    public function homeAction() {
        
      
        //log
        $this->_logger->info('Attivato ' . __METHOD__ . ' ');
        $this->_helper->layout->setLayout('main');
        /*Prendo la pagina da offerte del giorno e offerte in scadenza*/
        $pagedDelGiorno = $this->_getParam('pagedDelGiorno',1);
        $pagedScadenza = $this->_getParam('pageScadenza',1);
        //Estraggo dal DB la promozione per data odierna e in scadenza
        $offerteDelGiorno = $this->_PublicModel->getPromozioneByDate($pagedDelGiorno,null);
        $offertaInScadenza = $this->_PublicModel->getPromozioniInscadenza($pagedScadenza,null);

        //Estraggo le tipologie

        $tipologie = $this->_PublicModel->getTipologie();
        //Assegno alla view i prodotto da visualizzare
        $this->view->assign(array('offerteDelGiorno'=>$offerteDelGiorno,'offerteInScadenza'=>$offertaInScadenza,'tipologie'=>$tipologie));


      
    }
    
   public function categorieAction () {
       
        //log
        $this->_logger->info('Attivato ' . __METHOD__ . ' ');
        $this->_helper->layout->setLayout('main');
        $tipologie = $this->_PublicModel->getTipologie();
        $catId = $this->_getParam('catId', null);        
        

        /*Prendo pagina e la categoria selezionata dal database*/
        $pagedCategoria = $this->_getParam('pageCategoria',1);
        $offertaPerCategoria = $this->_PublicModel->getPromozioneByCategoria($catId,$pagedCategoria);
        $this->view->filtraAziendaTipologia =$this->getFiltraAziendaFormTipologia($catId);
        $this->view->assign(array('offertaPerCategoria'=>$offertaPerCategoria,'tipologie'=>$tipologie,'tipologiaselezionata'=>$catId));
      
             
      
        
   }
   
   public function categoriefiltrateAction() {
       
       
       if (!$this->getRequest()->isPost()) {
          
	}

        $formFiltro=new Application_Form_Public_Filtro_FiltroAzienda();
        
        if (!$formFiltro->isValid($_POST)) {
		$formRicerca->setDescription('Attenzione! dati inseriti non validi');
		return $this->render('categoriefiltrate');
        }
        $pagedCategoria = $this->_getParam('pageCategoria',1);
        $nomeDaCercare = $formFiltro->getValue('Filtro');
        $catId=$this->_getParam('nomecategoria');
        $tipologie = $this->_PublicModel->getTipologie();
        $offertaPerCategoria = $this->_PublicModel->getPromozioneByTipologiaAzienda($catId,$nomeDaCercare,$pagedCategoria);
        $this->view->assign(array('offertaPerCategoria'=>$offertaPerCategoria,'tipologie'=>$tipologie,'tipologiaselezionata'=>$catId,
        'nomecercato'=>$nomeDaCercare));
       
        
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
        $this->_helper->layout->setLayout('layoutstatic');
        $page = $this->_getParam('staticPage');
        $this->render($page);
    
    }
    
    /* Azione che attiva il profilo del brands selezionato*/
    
    
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
            
            $formRegistrazione->setDescription('ATTENZIONE! dati inseriti non validi!');
            $this->_logger->info('Attivato If della form registrazione');
            $formRegistrazione->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            $this->_logger->debug(print_r($formRegistrazione->getErrors(), true));
            return $this->render('registrazione');
            
        
        }
        $values = $formRegistrazione->getValues();
        $values['role']="user"; 
        $this->_PublicModel->insertUser($values);     
        $this->_helper->redirector('home');
    }
    
    //funzione per la ricerca
    public function ricercaAction() {
        
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('home');
	}
        $formRicerca = $this->_Searchform;
        
        if (!$formRicerca->isValid($_POST)) {
		$formRicerca->setDescription('Attenzione! dati inseriti non validi');
		return $this->render('home');
        }
        $this->_helper->layout->setLayout('main');
        $tipologie = $this->_PublicModel->getTipologie();
        $pagedRicerca = $this->_getParam('pageRicerca',1);
        $nomeDaCercare = $formRicerca->getValue('cercaOfferta');
        $scelta = $formRicerca->getValue('selezione');
        $this->_logger->info($scelta);
        $this->_logger->info($nomeDaCercare);
        $offertaRicercata = null;
        $offertaRicercata = $this->_PublicModel->cercaPromozione($scelta, $nomeDaCercare, $pagedRicerca);
        $this->view->assign(array('offertaRicercata'=>$offertaRicercata,'tipologie'=>$tipologie));
 }
 
    //funzione per ottenere la form registra
    public function getRegistraForm() {
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
	$this->_Searchform = new Application_Form_Public_Search_Searchofferta();
        $this->_Searchform->setAction($urlHelper->url(array(
				'controller' => 'public',
				'action' => 'ricerca'),
				'default'
				));
	return $this->_Searchform;
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
        $formLogin =  $this->_loginform;
        $formaData= $this->getRequest()->getPost();
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
    public function filtroaziendascadutiAction() {

        
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('home');
	}

        $formFiltro=$this->_filtraAziendaFormS;
        
        if (!$formFiltro->isValid($_POST)) {
		$formRicerca->setDescription('Attenzione! dati inseriti non validi');
		return $this->render('home');
        }
        $nomeDaCercare = $formFiltro->getValue('Filtro');
        $this->_logger->info($nomeDaCercare);
        $paged = $this->_getParam('pagedDelGiorno',1);
        $offerte = $this->_PublicModel->getPromozioneByDateAzienda($nomeDaCercare);
        $this->view->assign(array('offerte'=>$offerte,'nomecercato'=>$nomeDaCercare));
    }
        
        
  
    
    /*Azione della form filtra per tipologia le offerte in scadenza*/
    public function filtrotipologiaAction() {
        
                
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('home');
	}
        
        $formFiltro=$this->_formfiltratipologiaS;
        
        if (!$formFiltro->isValid($_POST)) {
		$formFiltro->setDescription('Attenzione! dati inseriti non validi');
		return $this->render('home');
        }
        $nomeDaCercare = $formFiltro->getValue('Filtro');
        $this->_logger->info($nomeDaCercare);
        $paged = $this->_getParam('pagedDelGiorno',1);
        $offerte = $this->_PublicModel->getPromozioniInscadenzaTipologia($nomeDaCercare,$paged,null);
        $this->view->assign(array('offerte'=>$offerte,'nomecercato'=>$nomeDaCercare));

        
        
    }
    
     /*Filtro per azienda offerte scadenza*/
    private function getFiltraAziendaFormS() {
        
        $urlHelper = $this->_helper->getHelper('url');
	$this->_filtraAziendaFormS = new Application_Form_Public_Filtro_FiltroAzienda();
        $this->_filtraAziendaFormS->setAction($urlHelper->url(array(
				'controller' => 'public',
				'action' => 'filtroazienda',
                                'form'=>'filtroaziendascaduti'),
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
                                'form'=>'filtrotipologiascaduti'),
				'default'
				));
	return $this->_filtratipologiaformS;
    }
    
    /*form per il filtra azienda in tipologia*/
    private function getFiltraAziendaFormTipologia($catId) {
        

        $urlHelper = $this->_helper->getHelper('url');
	$this->_filtraformaziendaform = new Application_Form_Public_Filtro_FiltroAzienda();

        $this->_filtraformaziendaform->setAction($urlHelper->url(array(
				'controller' => 'public',
				'action' => 'categoriefiltrate',
                                'nomecategoria'=>$catId),
				'default'
				));
        
	return $this->_filtraformaziendaform;

    }
 
}

