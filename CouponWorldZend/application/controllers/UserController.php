<?php

class UserController extends Zend_Controller_Action {
    protected $_logger;
    protected $_UserModel;
    protected $_authService;
    protected $_modificaProfiloForm;
    
   public function init()
    {
        $this->_logger = Zend_Registry::get("log"); //file log
        $this->_helper->layout->setLayout('layoutuser');
        $this->_authService = new Application_Service_Auth();
        
        $this->_UserModel = new Application_Model_User(); //model
        $this->view->modificaProfiloForm = $this->getModificaProfiloForm();
        
        /* azioni sulle form di inserimento */
        
        //Creo l'oggetto Auth
        $this->_authService = new Application_Service_Auth();
    }

    public function indexAction()
    {
        
       
    }
    
    public function stampaoffertaAction(){
      /*Disabilito il layout perchè viene caricata la pagina di Benvenuto*/
      $this->_helper->layout->disableLayout();
    
      $this->_logger->info('Attivato ' . __METHOD__ . ' ');
        
        $param= $this->_getParam('offertaid');
        
         $this->_logger->info($param);
        
         $stampafferta = $this->_UserModel->getPromozioneById($param);
         $this->_logger->debug(print_r($stampafferta, true));
         $this->view->assign(array('stampaofferta'=>$stampafferta));
         

    }
    
    public function modificaprofilopageAction(){
        
        $id = $this->_authService->getIdentity()->iduser;
        $utente = $this->_UserModel->getUserById($id);
        $utente = $utente->toArray();
        $this->view->assign(array('utente'=>$utente));
        $this->_modificaProfiloForm->populate($utente);
        
    }
    public function modificaAction(){
        
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
    
    public function visualizzacouponAction(){
        
        $id = $this->_authService->getIdentity()->iduser;
        $paged = $this->_getParam('page',1);
        $coupon = $this->_UserModel->getCouponByUser($id, $paged);
        $this->view->assign(array('coupon'=>$coupon));
    }
    
    private function getModificaProfiloForm() {
        
        $this->_modificaProfiloForm = new Application_Form_User_ModificaProfilo_ModificaProfilo();
        $urlHelper = $this->_helper->getHelper('url');
        $this->_modificaProfiloForm->setAction($urlHelper->url(array(
				'controller' => 'staff',
				'action' => 'modifica'),
				'default'
				));
        return $this->_modificaProfiloForm;
    }
    
    public function logoutAction() {
        
        $this->_authService->clear();
        return $this->_helper->redirector('home','public');
    }
}