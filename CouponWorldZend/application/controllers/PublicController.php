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

       

        $this->view->ricercaOffertaForm = $this->getRicercaForm();
       

        $this->view->SearchBrandsForm = $this->getSearchBrandsForm();


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
    
    
    
    public function searchAction(){
        
    }

    public function getSearchBrandsForm(){
       
       
        $urlHelper = $this->_helper->getHelper('url');
        $this->_helper->layout->setLayout('layoutstatic');
        $this->_form = new Application_Form_Public_Search_SearchBrands();
        $this->_form->setAction($urlHelper->url(array(
				'controller' => 'public',
				'action' => 'search'),
				'default'
				));
	return $this->_form;
        
        
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


        
    public function searchOfferta() {
            
        //va a controllare il request object se c`è una richiesta post
        if(!$this->getRequest()->isPost()) {
            $this->_helper->redirector('home');
                
            }
            $form=$this->_form;
            if(!$form->isValid($_POST)) {
                $form->setDescription('Dati inseriti non validi!');
                return $this->render('home');
            }
              
            $values = $form->getValues();
         
              
              
                          
            }
      
    private function getRicercaForm() {
        
        $urlHelper = $this->_helper->getHelper('url');
        $this->_form = new Application_Form_Public_Search_Searchofferta();
        $this->_form->setAction($urlHelper->url(array(
            'controller'=>'public',
            'action'=>'offerteRicercate'),
            'default'));
        return $this->_form;
        
    }
    
    public function offertericercateAction () {
        
        
    }
  

}
