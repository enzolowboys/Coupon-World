<?php

class PublicController extends Zend_Controller_Action {
    
    protected $_logger;
    protected $topId;
    protected $_publicModel;
    
    public function init() {
        
        /*Abilito il layout*/
        $this->_helper->layout->setLayout('main');
        $this->_logger = Zend_Registry::get("log"); //file log
        /* istanzio in model*/
        $this->_publicModel = new Application_Model_Public(); //model
       
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
        /*Prendo la pagina da offerte del giorno e offerte in scadenza*/
        $pagedDelGiorno = $this->_getParam('pagedDelGiorno',1);
        $pagedScadenza = $this->_getParam('pageScadenza',1);
        //Estraggo dal DB la promozione per data odierna e in scadenza
        $offerteDelGiorno = $this->_publicModel->getPromozioneByDate($pagedDelGiorno,null);
        $offertaInScadenza = $this->_publicModel->getPromozioneByLastDate($pagedScadenza,null);
        //Assegno alla view i prodotto da visualizzare
        $this->view->assign(array('offerteDelGiorno'=>$offerteDelGiorno,'offerteInScadenza'=>$offertaInScadenza));

    }
    
   public function categorieAction () {
       
       //log
        $this->_logger->info('Attivato ' . __METHOD__ . ' ');
        $catId = $this->_getParam('catId', null);
        $this->view->assign(array(
            'categoria' => $catId)
        );
        /*Prendo pagina e la categoria selezionata dal database*/
        $pagedCategoria = $this->_getParam('pageCategoria',1);
        $offertaPerCategoria = $this->_publicModel->getPromozioneByCategoria($catId,$pagedCategoria);
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
        
        $page = $this->_getParam('staticPage');
        $this->render($page);
    }
}

