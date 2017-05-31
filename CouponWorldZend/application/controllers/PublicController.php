<?php

class PublicController extends Zend_Controller_Action {
    
    protected $_logger;
    protected $topId;
    protected $_PublicModel;
    
    public function init() {
        
        /*Abilito il layout*/
    
        $this->_logger = Zend_Registry::get("log"); //file log

        /* istanzio il form */
        $this->_PublicModel = new Application_Model_Public(); //model
       
        $this->view->accediForm = $this->getAccediForm();
        
        $this->view->registraForm = $this->getRegistraForm();
        
        $this->view->searchForm = $this->getSearchForm();
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
        $this->_helper->layout->setLayout('main');

        /*Prendo la pagina da offerte del giorno e offerte in scadenza*/
        $pagedDelGiorno = $this->_getParam('pagedDelGiorno',1);
        $pagedScadenza = $this->_getParam('pageScadenza',1);
        //Estraggo dal DB la promozione per data odierna e in scadenza
        $offerteDelGiorno = $this->_PublicModel->getPromozioneByDate($pagedDelGiorno,null);
        $offertaInScadenza = $this->_PublicModel->getPromozioneByLastDate($pagedScadenza,null);
        //Assegno alla view i prodotto da visualizzare
        $this->view->assign(array('offerteDelGiorno'=>$offerteDelGiorno,'offerteInScadenza'=>$offertaInScadenza));


      
    }
    
   public function categorieAction () {
       
       //log
        $this->_logger->info('Attivato ' . __METHOD__ . ' ');
        $this->_helper->layout->setLayout('main');

        $catId = $this->_getParam('catId', null);
        $this->view->assign(array(
            'categoria' => $catId)
        );
        /*Prendo pagina e la categoria selezionata dal database*/
        $pagedCategoria = $this->_getParam('pageCategoria',1);
        $offertaPerCategoria = $this->_PublicModel->getPromozioneByCategoria($catId,$pagedCategoria);
        $this->view->assign(array('offertaPerCategoria'=>$offertaPerCategoria));
        
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
    
    
    public function registrautenteAction(){
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('home');
	}
        $form=$this->_form;
        
        if (!$form->isValid($_POST)) {
            $form->setDescription('ATTENZIONE! dati inseriti non validi!');
            return $this->render('registrazione');
        }
        
        $values = $form->getValues();
        $this->_PublicModel->salvaUtente($values);
        $this->_helper->redirector('home');
    }
    
    public function ricercaAction() {
        
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('home');
	}
        $form=$this->_form;
        
        if (!$form->isValid($_POST)) {
		$form->setDescription('Attenzione! dati inseriti non validi');
		return $this->render('home');
        }
        
        $this->_helper->layout->setLayout('main');
        $pagedRicerca = $this->_getParam('pageRicerca',1);
        $nomeDaCercare = $form->getValue('cercaOfferta');
        $scelta = $form->getValue('selezione');
        $offertaRicercata = null;
        if($scelta==='tipologia')
            $offertaRicercata = $this->_PublicModel->getPromozioneByTipologia($nomeDaCercare,$pagedRicerca);
        else if($scelta==='azienda')
            $offertaRicercata = $this->_PublicModel->SearchPromozioneByAzienda($nomeDaCercare,$pagedRicerca);
        else if($scelta==='nomeprodotto')
            $offertaRicercata = $this->_PublicModel->searchPromozioneByNome($nomeDaCercare,$pagedRicerca);
       
        $this->view->assign(array('offertaRicercata'=>$offertaRicercata,'flag'=>true,'nomeDaCercare'=>$nomeDaCercare));

        

        
    }

    private function getAccediForm() {
	$urlHelper = $this->_helper->getHelper('url');
        $this->_helper->layout->setLayout('layoutstatic');
	$this->_form = new Application_Form_Public_MyAccount_Accedi();
        $this->_form->setAction($urlHelper->url(array(
				'controller' => 'public',
				'action' => 'home'),
				'default'
				));
	return $this->_form;
    }
    
    private function getRegistraForm() {
	$urlHelper = $this->_helper->getHelper('url');
        $this->_helper->layout->setLayout('layoutstatic');
	$this->_form = new Application_Form_Public_Registrazione_Registra();
        $this->_form->setAction($urlHelper->url(array(
				'controller' => 'public',
				'action' => 'registrautente'),
				'default'
				));
	return $this->_form;
    }
    
    private function getSearchForm() {
        
        $urlHelper = $this->_helper->getHelper('url');
	$this->_form = new Application_Form_Public_Search_Searchofferta();
        $this->_form->setAction($urlHelper->url(array(
				'controller' => 'public',
				'action' => 'ricerca'),
				'default'
				));
	return $this->_form;
    }
    
    
    
    
    
    

  
}

