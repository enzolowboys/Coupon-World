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
        
        
        $this->_UserModel = new Application_Model_User(); //model
        
        $this->view->modificaProfiloForm = $this->getModificaProfiloForm();
        
       
        
        //Creo l'oggetto Auth
        $this->_authService = new Application_Service_Auth();
    }

    public function indexAction()
    {
       
       
    }
    //pagina del coupon stampabile
    public function stampaoffertaAction(){
     
      
      $this->_logger->info('Attivato ' . __METHOD__ . ' '); 
      $param = $this->_getParam('offertaid');
      $info['user_iduser']=$this->_authService->getIdentity()->iduser;
      
      
          
      $this->_helper->layout->disableLayout();
   
      $stampafferta = $this->_UserModel->getPromozioneById($param);

      if(!($this->_UserModel->verificaCoupon($info['user_iduser'], $param))) {
           
            /* inserisce nella tabella coupon in db tutte le informazioni del coupon */
            $stringacoupon = $this->stringaRandom(11);
            $info['promozione_idpromozione']=$param;
            $info['codicecoupon']=$stringacoupon;
            $this->_UserModel->insertCoupon($info);
            $this->view->assign(array('stampaofferta'=>$stampafferta,'stringacoupon'=>$stringacoupon));
            
        }
        else {
            
            $this->_helper->redirector('invalidocoupon');
        }
 
    }
    
    //pagina nel caso il coupon è già presto
    public function invalidocouponAction() {
        
           $this->_helper->layout->setLayout('layoutstatic');
    }
    
    //pagina di modifica del profilo
    public function modificaprofilopageAction(){
        

        $id = $this->_authService->getIdentity()->iduser;
        $utente = $this->_UserModel->getUserById($id);
        $utente = $utente->toArray();
        $this->view->assign(array('utente'=>$utente));
        $this->_modificaProfiloForm->populate($utente);
        
    }
    
    //azione di modifica del profilo
    public function modificaAction(){
        
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
        $id = $this->_authService->getIdentity()->iduser;
        
        /*Blocco try catch per l'update nel db */
        try{
            $this->_UserModel->updateUser($values,$id);
            $this->_helper->redirector('index');
        }
        catch(Exception $e){
            
            $form->setDescription('Dati non validi!Username già presente nel database');
            $this->_helper->redirector('modificaprofilopage');
            
        }
      
    }
    
    //metodo che ritorna la form profilo
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
    


    //pagina che visualizza le informazioni del coupon 
    public function visualizzacouponAction(){
        
        $id = $this->_authService->getIdentity()->iduser;
        $paged = $this->_getParam('page',1);
        //prendo i coupon dell'utente
        $coupon = $this->_UserModel->getCouponByUser($id, $paged);
        $this->view->assign(array('coupon'=>$coupon));
    }
    

    //azione di logout
    public function logoutAction() {
        
        $this->_authService->clear();
        return $this->_helper->redirector('home','public');
    }
    
    //metodo che genera una stringa random  
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