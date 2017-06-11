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
     
      $this->_helper->layout->disableLayout();
      $this->_logger->info('Attivato ' . __METHOD__ . ' '); 
      $param= $this->_getParam('offertaid');
      $this->_logger->info($param);
      
      /* assegno a stringacoupon il valore restituito al metodo stringaRandom (11 in quanto il codice coupon ha una lunghezza di 11 caratteri) */
      $stringacoupon = $this->stringaRandom(11);
     
      $stampafferta = $this->_UserModel->getPromozioneById($param);
     
      $this->view->assign(array('stampaofferta'=>$stampafferta,'stringacoupon'=>$stringacoupon ));
       
      /* inserisce nella tabella coupon in db tutte le informazioni del coupon */
      $info['promozione_idpromozione']=$param;
      $info['user_iduser']=$this->_authService->getIdentity()->iduser;
      $info['codicecoupon']=$stringacoupon;
      
      
      $contariga = $this->_UserModel->searchCouponByIdPromozione($param,$info['user_iduser']);
      $this->_logger->debug(print_r($contariga, true));
      
      /*
      if($contariga>=1){
          echo "myFunctionThree()";
      }
      else 
        $this->_UserModel->insertCoupon($info);    
      */
 
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
    
    
    private function getModificaProfiloForm() {
        
        $this->_modificaProfiloForm = new Application_Form_User_ModificaProfilo_ModificaProfilo();
        $urlHelper = $this->_helper->getHelper('url');
        $this->_modificaProfiloForm->setAction($urlHelper->url(array(
				'controller' =>'user',
				'action' => 'modifica'),
				'default'
				));
        return $this->_modificaProfiloForm;
    }
    


    
    public function visualizzacouponAction(){
        
        $id = $this->_authService->getIdentity()->iduser;
        $paged = $this->_getParam('page',1);
        $coupon = $this->_UserModel->getCouponByUser($id, $paged);
        $this->view->assign(array('coupon'=>$coupon));
    }
    

    
    public function logoutAction() {
        
        $this->_authService->clear();
        return $this->_helper->redirector('home','public');
    }
    
    
     public function stringaRandom($lunghezza){
        // lista di caratteri che comporranno la stringa random
        $caratteriPossibli = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        // inizializzo la stringa random
        $stringa = "";
        $i = 0;
        while ($i < $lunghezza) {
            // estrazione casuale di un un carattere dalla lista possibili caratteri
            $carattere = substr($caratteriPossibli,rand(0,strlen($caratteriPossibli)-1),1);
            // prima di inserire il carattere controllo non sia già presente nella stringa random fin'ora creata
            if (!strstr($stringa, $carattere)) {
                $stringa .= $carattere;
                $i++;
            }
        }
        return $stringa;
    }
}