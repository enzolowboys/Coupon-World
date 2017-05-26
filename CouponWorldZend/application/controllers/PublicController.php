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

    private function getAccediForm()
            
	{
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

  
}

